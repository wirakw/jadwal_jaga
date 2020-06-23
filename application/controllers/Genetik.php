<?php
defined('BASEPATH') OR exit('No direct script access allowed');
ini_set('max_execution_time', 1800);
ini_set('memory_limit','2048M');

class Genetik extends CI_Controller
{
    private $status_dev = array();
    private $primary = array();
    private $secondary = array();
    private $pengampu = array();
    private $dev = array(array());
    private $populasi;
    private $crossOver;
    private $mutasi;
    private $individu = array(array(array()));
    private $hari = array();
    private $jumlah_pengampu;

    	function __construct(){
    		parent::__construct();
        $this->load->library('form_validation');
        			$this->load->model("Generate");
    }

    	function penjadwalan(){
    		$data = array();

    		if(!empty($_POST)){

    			$this->form_validation->set_rules('jumlah_populasi','Jumlah Populiasi','xss_clean|required');
    			$this->form_validation->set_rules('probabilitas_crossover','Probabilitas CrossOver','xss_clean|required');
    			$this->form_validation->set_rules('probabilitas_mutasi','Probabilitas Mutasi','xss_clean|required');
    			$this->form_validation->set_rules('jumlah_generasi','Jumlah Generasi','xss_clean|required');
          $this->form_validation->set_rules('start','start','xss_clean|required');
          $this->form_validation->set_rules('end','end','xss_clean|required');
    				//tempat keajaiban dimulai. SEMANGAAAAAATTTTTTT BANZAIIIIIIIIIIIII !

    				$this->populasi = $this->input->post('jumlah_populasi');
    				$this->crossOver = $this->input->post('probabilitas_crossover');
    				$this->mutasi = $this->input->post('probabilitas_mutasi');
    				$jumlah_generasi = $this->input->post('jumlah_generasi');
            $start_generate = new DateTime($this->input->post('start'));
            $end_generate = new DateTime($this->input->post('end'));
			          $start = $this->input->post('start');

            $selisih =  $end_generate->diff($start_generate)->format("%a");
            $this->jumlah_pengampu = 2 * (intval($selisih) + 1);

    				$data['populasi'] = $this->populasi;
    				$data['probabilitas_crossover'] = $this->crossOver;
    				$data['probabilitas_mutasi'] = $this->mutasi;
    				$data['jumlah_generasi'] = $jumlah_generasi;

    					// $genetik = new genetik();
    					$this->AmbilData($start);
    					$this->Inisialisai();

    					$found = false;

    					for($i = 0;$i < $jumlah_generasi;$i++ ){
    						$fitness_total = $this->HitungFitness();

    						$this->Seleksi($fitness_total);
    						$this->StartCrossOver();

    						$fitnessAfterMutation = $this->Mutasi();

    						for ($j = 0; $j < count($fitnessAfterMutation); $j++){

    							if($fitnessAfterMutation[$j] == 1){

    								$this->db->query("TRUNCATE TABLE events");

    								$jadwal_jaga = array(array());
    								$jadwal_jaga = $this->GetIndividu($j);

    								for($k = 0; $k < count($jadwal_jaga);$k++){

    									$data['kode_pengampu'] = intval($jadwal_jaga[$k][0]);
                      $data['kode_hari'] = $this->hari[$k];
					      				//$data['kode_hari'] = $jadwal_jaga[$k][1];
                      if ($k % 2 == 1){
                        $data['kode_dev'] = intval($jadwal_jaga[$k][3]);
                      }
                      else {
                        $data['kode_dev'] = intval($jadwal_jaga[$k][2]);
                      }
                      $id = $data['kode_dev'];
                      $get_nama = $this->Generate->get_nama($id);
                      $data['nama'] = $get_nama['Nama'];
    									//$kode_status_dev = intval($jadwal_jaga[$k][3]);
                      if ($k % 2 == 1){
                        $data['status_jaga'] = 'secondary';
                        $data['color'] = '#6298ef';
                      }
                      else {
                        $data['status_jaga'] = 'primary';
                        $data['color'] = '#094cb7';
                      }
                      $this->Generate->insert_event($data);
    								}
    								$found = true;
    							}
    							if($found == true){break;}
    						}
    						if($found == true){break;}
    					}
    					if($found == false){
    						$data['msg'] = 'Tidak Ditemukan Solusi Optimal';
    					}

    			}else{
    				$data['msg'] = validation_errors();
    			}
				if(isset($_POST['tombol_submit'])){
				redirect(base_url().'Calendar');
				}
    		$data['rs_jadwal'] = $this->Generate->get();
    	  $this->load->view('penjadwalan',$data);
    	}

    public function AmbilData($start)
    {
      for ($i = 0; $i < $this->jumlah_pengampu; $i++) {
        $this->pengampu[$i] = $i;
        $day = date('D', strtotime($start));
        if ($i % 2 == 1){
            $start = date("Y-m-d", $date);
            $this->hari[$i] = $start;
            // $status = 1;
        }
        else {
          // $status = 2;
          if ($day == "Fri"){
            $date = strtotime("+3 day", strtotime($start));
            $start = date("Y-m-d", $date);
            $this->hari[$i] = $start;
            $this->jumlah_pengampu = $this->jumlah_pengampu - 2 ;
          }
          else if ($day == "Sat"){
            $date = strtotime("+2 day", strtotime($start));
            $start = date("Y-m-d", $date);
            $this->hari[$i] = $start;
            $this->jumlah_pengampu = $this->jumlah_pengampu - 2 ;
          }
          else if ($day == "Sun"){
            $date = strtotime("+1 day", strtotime($start));
            $start = date("Y-m-d", $date);
            $this->hari[$i] = $start;
            $this->jumlah_pengampu = $this->jumlah_pengampu - 2 ;
          }
        else {
            if($i == 0){
            $date = strtotime($start);
            }
            else {
            $date = strtotime("+1 day", strtotime($start));
            }
            $start = date("Y-m-d", $date);
            $this->hari[$i] = $start;
            }
        }
      // $this->status_dev[$i] = $status;
      }
      //get status dan id
      // $get_pengampu = $this->Generate->getPengampu();
      // $i=0;
      // foreach ($get_pengampu as $row) {
      //     $this->primary[$i] = intval($row['id']);
      //   //  $this->primary[$i] = $row['Status'];
      //   $i++;
      //   }

        $get_primary = $this->Generate->getPrimary();
        $i=0;
        foreach ($get_primary as $row) {
            $this->primary[$i] = intval($row['id']);
          //  $this->primary[$i] = $row['Status'];
          $i++;
          }

          $get_secondary = $this->Generate->getSecondary();
          $i=0;
          foreach ($get_secondary as $row) {
              $this->secondary[$i] = intval($row['id']);
            //  $this->primary[$i] = $row['Status'];
            $i++;
            }
    }

    public function Inisialisai()
    {

        $jumlah_primary = count($this->primary);
        $jumlah_second = count($this->secondary);


        for ($i = 0; $i < $this->populasi; $i++) {
            for ($j = 0; $j < $this->jumlah_pengampu; $j++) {

                $this->individu[$i][$j][0] = $j;

                $this->individu[$i][$j][1] = $j;//mt_rand(0, $jumlah_hari - 1); // Penentuan hari secara acak
                $this->individu[$i][$j][2] = mt_rand(0, $jumlah_primary - 1); // Penentuan nama dev.
                $this->individu[$i][$j][3] = mt_rand(0, $jumlah_second - 1); //mt_rand(0, $jumlah_status_dev - 1); // Penentuan nama dev.
            }
        }
    }

    private function CekFitness($indv) //$indv inisial statenya berapa ?
    {
        $penalty = 0;

        for ($i = 0; $i < $this->jumlah_pengampu; $i++)
        {
          $hari_a = intval($this->individu[$indv][$i][1]);
          $primary_a = intval($this->individu[$indv][$i][2]);
          $secondary_a = intval($this->individu[$indv][$i][3]);

          $sama = 0;
            for ($j = 0; $j < $this->jumlah_pengampu; $j++) {
                $hari_b = intval($this->individu[$indv][$j][1]);
                $primary_b = intval($this->individu[$indv][$j][2]);
                $secondary_b = intval($this->individu[$indv][$j][3]);


                if ($i == $j){
                    continue;}
                //primary == primary
                if ($this->hari[$hari_a] == $this->hari[$hari_b] && $primary_a == $primary_b ){
                    $penalty+=1;
                }
                if ($this->hari[$hari_a] == $this->hari[$hari_b] && $primary_a == $secondary_a ){
                    $penalty+=3;
                }
                if ($this->hari[$hari_a] == $this->hari[$hari_b] && $primary_a == $secondary_b ){
                    $penalty+=2;
                }
                if ($this->hari[$hari_a] == $this->hari[$hari_b] &&  $primary_b == $secondary_a ){
                    $penalty+=2;
                }
                if ($this->hari[$hari_a] == $this->hari[$hari_b] &&  $primary_b == $secondary_b ){
                    $penalty+=3;
                }
                if ($this->hari[$hari_a] == $this->hari[$hari_b] &&  $secondary_a == $secondary_b ){
                    $penalty+=1;
                }

      }
    }
        // echo $this->primary[$dev_a]." dan ".$this->primary[$dev_b]."<br>";
        $fitness = floatval(1 / (1 + $penalty));
        return $fitness;
    }

    public function HitungFitness()
    {


        //soft constraint //TODO
        $fitnesstotal = array();

        for ($indv = 0; $indv < $this->populasi; $indv++)
        {
            $fitnesstotal[$indv] = $this->CekFitness($indv);
        }

        return $fitnesstotal;
    }

    #endregion

    #region Seleksi
    public function Seleksi($fitness_total)
    {
        $jumlah = 0;
        $rank   = array();


        for ($i = 0; $i < $this->populasi; $i++)
        {
          //proses ranking berdasarkan nilai fitness
            $rank[$i] = 1;
            for ($j = 0; $j < $this->populasi; $j++)
            {
              //ketika nilai fitness jadwal sekarang lebih dari nilai fitness jadwal yang lain,
              //ranking + 1;
              //if (i == j) continue;

                $fitnessA = floatval($fitness_total[$i]);
                $fitnessB = floatval($fitness_total[$j]);

                if ( $fitnessA > $fitnessB)
                {
                    $rank[$i] += 1;
                }
            }

            $jumlah += $rank[$i];
        }

        $jumlah_rank = count($rank);
        for ($i = 0; $i < $this->populasi; $i++)
        {
            //proses seleksi berdasarkan ranking yang telah dibuat
            //int nexRandom = random.Next(1, jumlah);
            //random = new Random(nexRandom);
            $target = mt_rand(0, $jumlah - 1);

            $cek    = 0;
            for ($j = 0; $j < $jumlah_rank; $j++) {
                $cek += $rank[$j];
                if (intval($cek) >= intval($target)) {
                    $this->induk[$i] = $j;
                    break;
                }
            }
        }
    }
    #endregion

    public function StartCrossOver()
    {
        $individu_baru = array(array(array()));
      //  $this->jumlah_pengampu = count($this->pengampu);

        for ($i = 0; $i < $this->populasi; $i += 2) //perulangan untuk jadwal yang terpilih
        {
            $b = 0;

            $cr = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

            //Two point crossover
            if (floatval($cr) < floatval($this->crossOver)) {
                //ketika nilai random kurang dari nilai probabilitas pertukaran
                //maka jadwal mengalami prtukaran

                $a = mt_rand(0, $this->jumlah_pengampu - 2);
                while ($b <= $a) {
                    $b = mt_rand(0, $this->jumlah_pengampu - 1);
                }


                //var_dump($this->induk);


                //penentuan jadwal baru dari awal sampai titik pertama
                for ($j = 0; $j < $a; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }

                //Penentuan jadwal baru dai titik pertama sampai titik kedua
                for ($j = $a; $j < $b; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i + 1]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i]][$j][$k];
                    }
                }

                //penentuan jadwal baru dari titik kedua sampai akhir
                for ($j = $b; $j < $this->jumlah_pengampu; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }
            } else { //Ketika nilai random lebih dari nilai probabilitas pertukaran, maka jadwal baru sama dengan jadwal terpilih
                for ($j = 0; $j < $this->jumlah_pengampu; $j++) {
                    for ($k = 0; $k < 4; $k++) {
                        $individu_baru[$i][$j][$k]     = $this->individu[$this->induk[$i]][$j][$k];
                        $individu_baru[$i + 1][$j][$k] = $this->individu[$this->induk[$i + 1]][$j][$k];
                    }
                }
            }
        }

        //$this->jumlah_pengampu = count($this->pengampu);

        for ($i = 0; $i < $this->populasi; $i += 2) {
          for ($j = 0; $j < $this->jumlah_pengampu ; $j++) {
            for ($k = 0; $k < 4; $k++) {
                $this->individu[$i][$j][$k] = $individu_baru[$i][$j][$k];
                $this->individu[$i + 1][$j][$k] = $individu_baru[$i + 1][$j][$k];
            }
          }
        }
    }

    public function Mutasi()
    {
        $fitness = array();
        //proses perandoman atau penggantian komponen untuk tiap jadwal baru
        $r       = mt_rand(0, mt_getrandmax() - 1) / mt_getrandmax();

        $jumlah_primary = count($this->primary);
        $jumlah_second = count($this->secondary);

        for ($i = 0; $i < $this->populasi; $i++) {

            if ($r < $this->mutasi) {
                //Penentuan pada matakuliah dan kelas yang mana yang akan dirandomkan atau diganti
                $krom = mt_rand(0, $this->jumlah_pengampu - 1);
                $this->individu[$i][$krom][1] =$i;
                $this->individu[$i][$krom][2] = mt_rand(0, $jumlah_primary - 1); // Penentuan nama dev.
                $this->individu[$i][$krom][3] = mt_rand(0, $jumlah_second - 1); // Penentuan tipe

            }

            $fitness[$i] = $this->CekFitness($i);
        }
        return $fitness;
    }


    public function GetIndividu($indv)
    {
        //return individu;

        //int[,] individu_solusi = new int[mata_kuliah.Length, 4];
        $individu_solusi = array(array());
//    $this->jumlah_pengampu = count($this->pengampu);

        for ($j = 0; $j < $this->jumlah_pengampu; $j++)
        {
            $individu_solusi[$j][0] = intval($this->pengampu[$this->individu[$indv][$j][0]]);
            $individu_solusi[$j][1] = $this->hari[$this->individu[$indv][$j][1]];
            $individu_solusi[$j][2] = intval($this->primary[$this->individu[$indv][$j][2]]);
            $individu_solusi[$j][3] = intval($this->secondary[$this->individu[$indv][$j][3]]);
        }

        return $individu_solusi;
    }



}
