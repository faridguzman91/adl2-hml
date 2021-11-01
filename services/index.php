<?php	
	require_once '../../../includes/motown_config.php';
	require_once '../../../includes/API.class.php';


	class MOtownAPI extends API{
		

		public function getdata(){
	     	header('Cache-Control: no-cache');
			header('Pragma: no-cache');
			
			$use_api = true;

			if($use_api){
				//merge status file:
				
				//$time_start = microtime(true); 

				$api_file = 'api_cache.json';
				$api_url = 'http://api.bpd.nl/light/projects/a067R0000306PkiQAE/constructionnumbers';
				$api = json_decode(file_get_contents($api_file), false);

				if($api){
					
					$json = json_decode(file_get_contents(PROJECT_NAME.'.json'), false);
					$houses = $json->house;
					
					$i = count($houses);
					while($i--){
						$id = $houses[$i]->id;
						$j = count($api);
						while($j--){
							if(isset($api[$j]->Number) && ltrim((string)$api[$j]->Number, '0') === ltrim($id, '0')){


								//$houses[$i]->disabled = false;//enable

								$houses[$i]->roomcount = $api[$j]->NumberOfRooms;
								$houses[$i]->bedroomcount = $api[$j]->NumberOfBedooms;
								$houses[$i]->livingsurface = $api[$j]->LivingArea;
								$houses[$i]->price = $api[$j]->SalesPrice;
								$houses[$i]->name = $api[$j]->PropertyName;
								$houses[$i]->type = $api[$j]->PropertyId;
								$houses[$i]->volume = $api[$j]->Volume;
								
								//$l = [];
								//foreach($api[$j]->Floors as $f){
								//	$l[] = $f->FloorNumber;
								//}
								//sort($l);
								//$houses[$i]->level = $l;

								$houses[$i]->level = $api[$j]->MainFloorNumber;
								
								$s = strtolower($api[$j]->Status);
								if($s == 'tekenafspraak') $s = 'optie';
								if($s == 'invoorbereiding') $s = 'in voorbereiding';
								
								//if(in_array($id, $exclude_ids)){
								//	$s = 'niet beschikbaar';
								//}

								$houses[$i]->status = $s;

								if(isset($api[$j]->Gardens) && count($api[$j]->Gardens)){
									$l = $api[$j]->Gardens[0]->Position;
									$g = $api[$j]->Gardens[0]->Size;
								}else $g = $l = null;

								$houses[$i]->terrace = $g;
								$houses[$i]->orientationterrace = $l;
								
								$houses[$i]->url = 'https://www.nieuwbouw-motown.nl/woningen/'.urlencode(strtolower(str_replace(' ', '-', $api[$j]->PropertyName))).'-woningtype-'.urlencode($api[$j]->PropertyId).'/bouwnummer-'.urlencode($api[$j]->Number);


								break;
							}
						}
					}

					//$time_end = microtime(true);
					//echo $execution_time = ($time_end - $time_start);

					$this->output = json_encode($json);
				}
				//update status in background process:
				$this->writeResponseToFile($api_file, $api_url, 12);
			}
			if(!isset($this->output))$this->output = file_get_contents(PROJECT_NAME.'.json');
		}
	}

	$api = new MOtownAPI();
	$api->output();
