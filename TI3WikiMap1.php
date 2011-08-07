<?php

$wgExtensionFunctions[] = 'wfTI3WikiMapFunctions';

$wgHooks['LanguageGetMagic'][]       = 'wfTI3WikiMap_Magic';
$wgExtensionCredits['parserhook'][] = array(
'name' => 'TI3WikiMapFunctions v0.1',
);

function wfTI3WikiMap_Magic(&$magicWords, $langCode ) {
        # Add the magic word
        # The first array element is case sensitive, in this case it is not case sensitive
        # All remaining elements are synonyms for our parser function
        #$magicWords['example'] = array( 0, 'example' );
        # unless we return true, other parser functions extensions won't get loaded.

		
    $magicWords['TI3WikiMap']= array( 0, 'TI3WikiMap' );
    $magicWords['mapTile']= array( 0, 'mapTile' );
    $magicWords['mapUnit']= array( 0, 'mapUnit' );
    $magicWords['mapSet']= array( 0, 'mapSet' );
    $magicWords['mapGet']= array( 0, 'mapGet' );

    $magicWords['mapPlanet']= array( 0, 'mapPlanet' );
    $magicWords['mapShip']= array( 0, 'mapShip' );
    $magicWords['mapCarrier']= array( 0, 'mapCarrier' );
    $magicWords['mapWarsun']= array( 0, 'mapWarsun' );
    $magicWords['mapDestroyer']= array( 0, 'mapDestroyer' );
    $magicWords['mapCruiser']= array( 0, 'mapCruiser' );
    $magicWords['mapDreadnaught']= array( 0, 'mapDreadnaught' );
    $magicWords['mapLeader']= array( 0, 'mapLeader' );
    $magicWords['mapCC']= array( 0, 'mapCC' );
    $magicWords['mapToken']= array( 0, 'mapToken' );
    $magicWords['mapFlag']= array( 0, 'mapFlag' );

	$magicWords['mapImg']= array( 0, 'mapImg' );
	$magicWords['mapImgRedirect']= array( 0, 'mapImgRedirect' );
	$magicWords['mapInclude']= array( 0, 'mapInclude' );
	
    return true;
}

$TI3WikiMapHooks = array( 	'TI3WikiMap'
						,'mapTile'
						,'mapUnit'
						,'mapSet'
						,'mapGet'
						,'mapPlanet'
						,'mapShip'
						,'mapCarrier'
						,'mapWarsun'
						,'mapDestroyer'
						,'mapCruiser'
						,'mapDreadnaught'
						,'mapLeader'
						,'mapCC'
						,'mapToken'
						,'mapFlag'
						,'mapImg'
						,'mapImgRedirect'
					);

function wfTI3WikiMapFunctions() {
    global $wgParser, $wgExtTI3WikiMapFunctions, $wgStrPosMaxKeyLength;

    $wgExtTI3WikiMapFunctions = new ExtTI3WikiMapFunctions();
    $wgStrPosMaxKeyLength = 30;

//	foreach($TI3WikiMapHooks as $i)
//		$wgParser->setFunctionHook( $i,       array( &$wgExtTI3WikiMapFunctions, $i ) );

    $wgParser->setFunctionHook( 'TI3WikiMap',       array( &$wgExtTI3WikiMapFunctions, 'TI3WikiMap' ) );
    $wgParser->setFunctionHook( 'mapTile',       array( &$wgExtTI3WikiMapFunctions, 'mapTile' ) );
    $wgParser->setFunctionHook( 'mapUnit',       array( &$wgExtTI3WikiMapFunctions, 'mapUnit' ) );
    $wgParser->setFunctionHook( 'mapSet',       array( &$wgExtTI3WikiMapFunctions, 'mapSet' ) );
    $wgParser->setFunctionHook( 'mapGet',       array( &$wgExtTI3WikiMapFunctions, 'mapGet' ) );

    $wgParser->setFunctionHook( 'mapPlanet',       array( &$wgExtTI3WikiMapFunctions, 'mapPlanet' ) );
    $wgParser->setFunctionHook( 'mapShip',       array( &$wgExtTI3WikiMapFunctions, 'mapShip' ) );
    $wgParser->setFunctionHook( 'mapCarrier',       array( &$wgExtTI3WikiMapFunctions, 'mapCarrier' ) );
    $wgParser->setFunctionHook( 'mapWarsun',       array( &$wgExtTI3WikiMapFunctions, 'mapWarsun' ) );
    $wgParser->setFunctionHook( 'mapDestroyer',       array( &$wgExtTI3WikiMapFunctions, 'mapDestroyer' ) );
    $wgParser->setFunctionHook( 'mapCruiser',       array( &$wgExtTI3WikiMapFunctions, 'mapCruiser' ) );
    $wgParser->setFunctionHook( 'mapDreadnaught',       array( &$wgExtTI3WikiMapFunctions, 'mapDreadnaught' ) );
    $wgParser->setFunctionHook( 'mapLeader',       array( &$wgExtTI3WikiMapFunctions, 'mapLeader' ) );
    $wgParser->setFunctionHook( 'mapCC',       array( &$wgExtTI3WikiMapFunctions, 'mapCC' ) );
    $wgParser->setFunctionHook( 'mapToken',       array( &$wgExtTI3WikiMapFunctions, 'mapToken' ) );
    $wgParser->setFunctionHook( 'mapFlag',       array( &$wgExtTI3WikiMapFunctions, 'mapFlag' ) );

//	$wgParser->setFunctionHook( 'mapTest',       array( &$wgExtTI3WikiMapFunctions, 'mapTest' ) );
	$wgParser->setFunctionHook( 'mapImg',       array( &$wgExtTI3WikiMapFunctions, 'mapImg' ) );
	$wgParser->setFunctionHook( 'mapImgRedirect', array( &$wgExtTI3WikiMapFunctions, 'mapImgRedirect' ) );
	$wgParser->setFunctionHook( 'mapInclude', array( &$wgExtTI3WikiMapFunctions, 'mapInclude' ) );

}

class ExtTI3WikiMapFunctions
{
/*	function mapTest(&$parser )
	{
		$Link = "Template:Example_PBeM_WikiMap:1,1";
		
		$title = Title::newFromText( $Link );
		
		$pageExists = is_object( $title ) && $title->exists();
		if(!$pageExists)
			return "";

		$r = Revision::newFromTitle($title);
		if(!is_object($r))
			return "";
		
		return $r->getText();
	}*/
	
	private static $mapDefaultArgs = array ( 
							'Type' => 'GF'
							,'Color' => 'Grey'
							,'Damaged' => ''
							,'Race' => ''
							,'Quantity' => '1'
							,'Planet' => ''
							,'Where' => '0'
							,'X' => '0'
							,'Y' => '0'
							,'Z' => '1'
							,'YOffset' => '50'
							,'Scale' => '1'

							,'Spacedock' => '0'
							,'Fighters' => '0'
							,'GF' => '0'
							,'ST' => '0'
							,'PDS' => '0'
              
              ,'Artifact' => ''
              ,'DS' => ''
              
							,'Tile' => 'Empty'
							,'Label' => ''
							,'Format' => 'gif'
							
							,'ImageLink' => ''
							,'LabelColor' => 'white'
							,'Width' => '7'
							,'Height' => '7'
							,'SaveMap' => '0'
							,'ShowNumbers' => '1'

							,'ScaleLinks' => '1'
							,'BrowserWarning' => '1'
							,'PageExistsXYLinks' => '1'
							,'PageMissingXYLinks' => '1'
							,'TileImageLinks' => '1'
							,'HelpIncludeLinks' => '1'
							);
	private $args;
	private $Left, $Top;
	
	private static $imgWidth = array(
		'Destroyer' => 42
		,'Cruiser' => 55
		,'Dreadnaught' => 79	
		,'Warsun' => 135
		,'Carrier' => 50
		,'Fighter' => 50
		,'GF' => 48
		,'PDS' => 67
		,'Spacedock' => 76 
		,'Admiral' => 30
		,'Agent' => 30
		,'Diplomat' => 30
		,'General' => 30
		,'Scientist' => 30
		,'LgRnd' => 60
		,'SmRnd' => 30
		,'CC' => 100
		,'High_Alert' => 99
		,'Space_Mines' => 105
		,'Wormhole_A' => 97
		,'Wormhole_B' => 97
		,'Wormhole_C' => 100
		,'Wormhole_L' => 95
		,'Custodians-Fighter3' => 85
		,'Custodians-GF2' => 85
		);

	private static $imgHeight = array(
		'Destroyer' => 56
		,'Cruiser' => 105
		,'Dreadnaught' => 159
		,'Warsun' => 113
		,'Carrier' => 139
		,'Fighter' => 36
		,'GF' => 57
		,'PDS' => 49
		,'Spacedock' => 78 
		,'Admiral' => 30
		,'Agent' => 30
		,'Diplomat' => 30
		,'General' => 30
		,'Scientist' => 30
		,'LgRnd' => 60
		,'SmRnd' => 30
		,'CC' => 88
		,'High_Alert' => 99
		,'Space_Mines' => 94
		,'Wormhole_A' => 100
		,'Wormhole_B' => 100
		,'Wormhole_C' => 103
		,'Wormhole_L' => 99
		,'Custodians-Fighter3' => 85
		,'Custodians-GF2' => 85
		);
	
	private static $clockX = array(216,304,368,391,361,297,215,133,64,35,68,132,212);
	private static $clockY = array(188,60,119,188,263,317,336,315,262,186,117,60,42);

	private static $planetCodes = array(
			'HS-Muaat' => 'HSP1'
			,'HS-L1z1x' => 'HSP1'
			,'HS-Mentak' => 'HSP1'
			,'HS-Sol' => 'HSP1'
			,'Arretze' => 'HS3xP1'
			,'Kamdorn' => 'HS3xP2'
			,'Hercant' => 'HS3xP3'
			,'Arc Prime' => 'HS2xP1'
			,'Arc_Prime' => 'HS2xP1'
			,'Wren Terra' => 'HS2xP2'
			,'Wren_Terra' => 'HS2xP2'
			,'Retillion' => 'HS2xP1'
			,'Shalloq' => 'HS2xP2'
			,'Jord' => 'HSP1'
			,'Maaluuk' => 'HS2xP1'
			,'Druaa' => 'HS2xP2'
			,'[0,0,0]' => 'HSP1'
			,'000' => 'HSP1'
			,'Nar' => 'HS2xP1'
			,'Jol' => 'HS2xP2'
			,'Muaat' => 'HSP1'
			,'Tren\'lak' => 'HS2xP1'
			,'Trenlak' => 'HS2xP1'
			,'Quinarra' => 'HS2xP2'
			,'Archon Ren' => 'HS2xP1'
			,'Archon_Ren' => 'HS2xP1'
			,'Archon Tau' => 'HS2xP2'
			,'Archon_Tau' => 'HS2xP2'
			,'Moll Primus' => 'HSP1'
			,'Moll_Primus' => 'HSP1'
			,'Mecatol Rex' => 'P1'
			,'Mecatol_Rex' => 'P1'
			,'New Albion' => '2xP1'
			,'New_Albion' => '2xP1'
			,'Starpoint' => '2xP2'
			,'Bereg' => '2xP1'
			,'Lirta' => '2xP2'
			,'Lirta IV' => '2xP2'
			,'Lirta_IV' => '2xP2'
			,'Tequ\'ran' => '2xP1'
			,'Tequran' => '2xP1'
			,'Torkan' => '2xP2'
			,'Coorneeq' => '2xP1'
			,'Resculon' => '2xP2'
			,'Saudor' => 'P1'
			,'Vefut II' => 'P1'
			,'Vefut_II' => 'P1'
			,'Tar\'mann' => 'P1'
			,'Tarmann' => 'P1'
			,'Lazar' => '2xP1'
			,'Sakulag' => '2xP2'
			,'Dal Bootha' => '2xP1'
			,'Dal_Bootha' => '2xP1'
			,'Xxehan' => '2xP2'
			,'Arnor' => '2xP1'
			,'Lor' => '2xP2'
			,'Mehar Xull' => 'P1'
			,'Mehar_Xull' => 'P1'
			,'Thibah' => 'P1'
			,'Quann' => 'WHP1'
			,'Wellon' => 'P1'
			,'Lodor' => 'WHP1'
			,'Abyz' => '2xP1'
			,'Fria' => '2xP2'
			,'Mellon' => '2xP1'
			,'Zohbat' => '2xP2'
			,'Centauri' => '2xP1'
			,'Gral' => '2xP2'
			,'Qucen\'n' => '2xP1'
			,'Qucenn' => '2xP1'
			,'Rarron' => '2xP2'
			,'Arinam' => '2xP1'
			,'Meer' => '2xP2'
			
			,'Ashtroth' => '3xP1'
			,'Loki' => '3xP2'
			,'Abaddon' => '3xP3'
			,'Capha' => 'P1'
			,'Elnath' => 'P1'
			,'Garbozia' => 'P1'
			,'Hopes_End' => 'P1'
			,'Hopes End' => 'P1'
			,'Lesab' => 'P1'
			,'Lisis' => '2xP1'
			,'Velnor' => '2xP2'
			,'Mirage' => 'P1'
			,'Nexus' => 'NXP1'
			,'Mallice' => 'NXP1'
			,'Perimeter' => 'P1'
			,'Primor' => 'P1'
			,'Rigel I' => '3xP1'
			,'Rigel II' => '3xP2'
			,'Rigel III' => '3xP3'
			,'Rigel_I' => '3xP1'
			,'Rigel_II' => '3xP2'
			,'Rigel_III' => '3xP3'
			,'Sumerian' => '2xP1'
			,'Arcturus' => '2xP2'
			,'Tsion' => '2xP1'
			,'Bellatrix' => '2xP2'
			,'Vega_Minor' => '2xP1'
			,'Vega_Major' => '2xP2'
			,'HS-Winnu' => 'HSP1'
			,'Winnu' => 'HSP1'
			,'HS-Yin' => 'HSP1'
			,'Darien' => 'HSP1'
			,'Lisis II' => 'HS2xP1'
			,'Lisis_II' => 'HS2xP1'
			,'Ragh' => 'HS2xP2'
		);
	private static $planetX = array(
			'P1' => 216
			,'WHP1' => 140
			,'2xP1' => 140
			,'2xP2' => 290
			,'HSP1' => 216
			,'HS2xP1' => 140
			,'HS2xP2' => 314
			,'HS3xP1' => 195
			,'HS3xP2' => 316
			,'HS3xP3' => 142 

			,'3xP1' => 216
			,'3xP2' => 302
			,'3xP3' => 123
			,'NXP1' => 167
			);
	private static $planetXOffset = array(0,37,37,-37,-37);
	private static $planetY = array(
			'P1' => 188
			,'WHP1' => 114
			,'2xP1' => 114
			,'2xP2' => 260
			,'HSP1' => 160
			,'HS2xP1' => 144
			,'HS2xP2' => 190
			,'HS3xP1' => 91
			,'HS3xP2' => 194
			,'HS3xP3' => 235 

			,'3xP1' => 82
			,'3xP2' => 229
			,'3xP3' => 240
			,'NXP1' => 193
			);
	private static $planetYOffset = array(0,-37,37,37,-37);

	private static $planetRadius = 37;
	private static $planetPositions = array ( array(), array ( 0,0), array ( 0,37, 0,-37), array(0,37, 37,-37, -37,-37), array(37,37 ,37,-37, -37,-37, -37,37) );

	private function valid_string($str)
	{
		return !preg_match('/[^a-zA-Z0-9\:\/\.\-\_\ \Ä\ä\Ö\ö\Ü\ü\
   ]+$/s',$str);
	}
	private function _parseNamedArguments($argArray, $defaultArg = 'Default')
	{
		// Set initial arguments to default
		$this->args = self::$mapDefaultArgs;
			
		// Loop through parameters and assign values to them
		foreach($argArray as $i)
		{
			// If object in array is not a string then just skip it (first argument is not a string)
			if(!is_string($i))
				continue;
			
			// Split the argument on the =, ie Label=Red
			$a = explode('=',$i);
			
			// If parse fails then skip it
			if($a === false || count($a) < 1)
				continue;
			
			// If there is no value for parameter, ie Label=
			if(count($a) == 1)
			{
				// Ensure the parameter string does not contain any invalid characters
				if(!$this->valid_string($a[0]))
					continue;
				
				// if no = was specified for this parameter(ie Red) 
				if($a[0] === $i && strlen($a[0]) > 0)
					// then assign this value to the default argument 
					$this->args[$defaultArg] = $a[0];
				// else assign empty string to the value (ie Label=)
				else $this->args[$a[0]] = '';
			}
			else 
			{
				// Label has two arguments, ie Label=Red
				
				// If either argument contains invalid characters then skip it
				if(!$this->valid_string($a[0]) || !$this->valid_string($a[1]))
					continue;
					
				// Change parameter to new value
				$this->args[$a[0]] = $a[1];
			}
		}
	}
	
    function mapSet( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args);
		
		// Set default arguments to new values
		self::$mapDefaultArgs = $this->args;
	}
	
	function mapGet( &$parser )
	{
		// Dump default arguments
		foreach(array_keys(self::$mapDefaultArgs) as $i)
		{
			$temp = self::$mapDefaultArgs[$i];
			$retv .= "$i = $temp\n\n";
		}
		return $retv;
	}
	
	private $redirects = array();
	
    function mapImgRedirect( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Img');
		
		// Create a new redirect by setting the key to the image URL to the redirected URL
		if($this->args['Img'] !== null)
			$this->redirects[$this->args['Img']] = $this->args['Redirect'];
		
		if($this->args['Multi'] !== null)
		{
			$lines = explode("\n",$this->args['Multi']);
			for($i=0;$i<count($lines);$i++)
			{
				if(substr($lines[$i], 0, strlen('http://')) == 'http://')
				{
					$this->redirects[trim($lines[$i])] = trim($lines[$i+1]);
					$i++;
				}
			}
		}
	}
	
	private function _GetPlanetLeftTop()
	{
		$Where = $this->args['Where'];
		$Planet = $this->args['Planet'];
		
		// If a planet value was specified
		if(strlen($Planet) > 0)
			// If the $Planet specified has a planetCode assigned use that, otherwise just treat $Planet as the code
			$PlanetCode = isset(self::$planetCodes[$Planet]) ? self::$planetCodes[$Planet] : $Planet;
		// If no planet was specified then assign the name of the last tile used
		else $PlanetCode = self::$planetCodes[$this->args['Tile']];
		
		// Lookup the x,y values of the planet code plus the x,y offset
		$this->Left = self::$planetX[$PlanetCode] + self::$planetXOffset[$Where] + $this->args['X'];
		$this->Top = self::$planetY[$PlanetCode] + self::$planetYOffset[$Where] + $this->args['Y'];
	}
	
	private function _GetLeftTop()
	{
		$Where = $this->args['Where'];
		$Planet = $this->args['Planet'];
		
		// If no planet is specified 
		if(strlen($Planet) == 0)
		{
			// then use the where value to lookup clock position x,y plus the x,y offset
			$this->Left = self::$clockX[$Where] + $this->args['X'];
			$this->Top = self::$clockY[$Where] + $this->args['Y'];
		}
		else
		{
			// If the $Planet specified has a planetCode assigned use that, otherwise just treat $Planet as the code
			$PlanetCode = isset(self::$planetCodes[$Planet]) ? self::$planetCodes[$Planet] : $Planet;
			
			// Lookup the x,y values of the planet code plus the x,y offset
			$this->Left = self::$planetX[$PlanetCode] + self::$planetXOffset[$Where] + $this->args['X'];
			$this->Top = self::$planetY[$PlanetCode] + self::$planetYOffset[$Where] + $this->args['Y'];
		}
	}
	
    function mapUnit( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Type');
		
		// Cache local arguments
		$Type = $this->args['Type'];
		$Race = $this->args['Race'];
		$Quantity = $this->args['Quantity'];
		$Color = $this->args['Color'];
		$Damaged = $this->args['Damaged'];
		$Scale = $this->args['Scale'];
		$Format = $this->args['Format'];

		// _mapUnit
		$this->_GetLeftTop();
		
		if(strlen($Type)>0 && ctype_digit($Type[strlen($Type)-1]))
			$BaseType = substr($Type, 0, strlen($Type)-1);
		else $BaseType = $Type;
		
		switch($BaseType)
		{
			case 'Admiral' :
			case 'Agent' :
			case 'Diplomat' :
			case 'General' :
			case 'Scientist' :
				if(strlen($Race) > 0)
					$retv .= $this->_mapRaceLeaderHTML($Race, $Type, $this->Left, $this->Top, $Scale, $Format);
				else $retv.= $this->_mapMiniLeaderHTML($Type, $this->Left, $this->Top, $Scale, $Format);
				break;
			default:
				$retv .= $this->_mapUnitHTML($Type, $Quantity, ($Quantity > 1), $Color, $Damaged, $this->Left, $this->Top, $Scale, $Format);
		}

		return $retv;
	}

	function mapPlanet( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Planet');
		
		// Cache local arguments
		$Planet = $this->args['Planet'];
		$Race = $this->args['Race'];
		$Color = $this->args['Color'];
		$Spacedock = $this->args['Spacedock'];
		$Fighters = $this->args['Fighters'];
		$GF = $this->args['GF'];
		$ST = $this->args['ST'];
		$PDS = $this->args['PDS'];
		$DS = $this->args['DS'];
		$Artifact = $this->args['Artifact'];
		$Scale = $this->args['Scale'];
		$Format = $this->args['Format'];

		// _mapPlanet
		$this->_GetPlanetLeftTop();
		$PX = $this->Left;
		$PY = $this->Top;
		
    $retv = '';
		$tokenCount = 0;
		
		$ShowRace = $Race != '';
		$ShowDS = $DS != '';
		$ShowArtifact = $Artifact != '';
		if($ShowRace) $tokenCount++;
		if($ShowDS) $tokenCount++;
		if($ShowArtifact) $tokenCount++;
		
		$tokenIDX = 0;
		
		if($ShowRace)
		{
			$Left = $PX + self::$planetPositions[$tokenCount][$tokenIDX];
			$Top = $PY + self::$planetPositions[$tokenCount][$tokenIDX+1];
			
			$retv .= $this->_mapFlagHTML('LgRnd',$Race, $Left, $Top, $Scale, $Format);
			
			$tokenIDX+=2;
		};
		if($ShowDS)
		{
			$Left = $PX + self::$planetPositions[$tokenCount][$tokenIDX];
			$Top = $PY + self::$planetPositions[$tokenCount][$tokenIDX+1];

			$retv .= $this->_mapDSHTML($DS, $Left, $Top, $Scale, $Format);
			$tokenIDX+=2;
		}
		if($ShowArtifact)
		{
			$Left = $PX + self::$planetPositions[$tokenCount][$tokenIDX];
			$Top = $PY + self::$planetPositions[$tokenCount][$tokenIDX+1];

			$retv .= $this->_mapArtifactHTML($Artifact, $Left, $Top, $Scale, $Format);
			$tokenIDX+=2;
		}
		
		$ShowSpacedock = $Spacedock > 0;
		$ShowGF = $GF > 0 || $ST > 0;
		$ShowPDS1 = $PDS > 0;
		$ShowPDS2 = $PDS > 1;
		
		if($ShowSpacedock)
		{
			$Left = $PX - self::$planetRadius;
			$Top = $PY - self::$planetRadius;
			
			$retv = $this->_mapUnitHTML('Spacedock', 1, false, $Color, '', $Left, $Top, $Scale, $Format);
			if($Fighters > 0)
			{
				$Left -= 20;
				$Top -= 60;
				$retv .= $this->_mapUnitHTML('Fighter', $Fighters, true, $Color, '', $Left, $Top, $Scale, $Format);
			}
		}
		if($ShowGF)
		{
			$Left = $PX + self::$planetRadius;
			$Top = $PY - self::$planetRadius;
			
			$retv .= $this->_mapGFHTML($GF, $ST, $Color, $Left, $Top, $Scale, $Format);
		}
		if($ShowPDS1)
		{
			$Left = $PX + self::$planetRadius;
			$Top = $PY + self::$planetRadius;
			
			$retv .= $this->_mapUnitHTML('PDS', 1, false, $Color, '', $Left, $Top, $Scale, $Format);
		}
		if($ShowPDS2)
		{
			$Left = $PX - self::$planetRadius;
			$Top = $PY + self::$planetRadius;
			
			$retv .= $this->_mapUnitHTML('PDS', 1, false, $Color, '', $Left, $Top, $Scale, $Format);
			//$unitIDX+=2;
		}
		
		
		return $retv;

	}

	function mapTile( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Tile');
		self::$mapDefaultArgs['Tile'] = $this->args['Tile'];
		
		// Cache local arguments
		$Tile = $this->args['Tile'];
		$Label = $this->args['Label'];
		$LabelColor = $this->args['LabelColor'];
		$Scale = $this->args['Scale'];
		
		// _mapTileHTML
		$ScaledWidth = 432 * $Scale;
		$YOffset = $this->args['YOffset'];
		
		$Content = "http://www.ti3wiki.org/wikimap/${Scale}/Tile-${Tile}.gif";
		if(array_key_exists($Content, $this->redirects))
			$Content = $this->redirects[$Content];
		
		$Link = $this->args['ImageLink'];
		if(strlen($Link) > 0)
			$Content = "<span class=\"plainlinks\">[{{SERVER}}{{localurl:${Link}}} ${Content}]</span>";
		
		$retv = "<div style=\"position: absolute; left: 0px; top: ${YOffset}px; z-index: 0;\">${Content}</div>";
		if($Label != null)
		{
			$Top = 198;
			$FontPX = 40;

			$Top -= 30;
			$ScaledFontPX = $FontPX * $Scale;
			
			
			$Top = ($Top * $Scale) + ($this->args['YOffset']);
			// Compensate for drift downward as font size decreases
//			$Top -= (2.2/$Scale);
			$ScaledWidth = 432 * $Scale;
			
			$retv .= "<div style=\"position: absolute; left: 0px; top: ${Top}px; z-index: 0; background-color: transparent; border-style: none; font-size: ${ScaledFontPX}px; width: ${ScaledWidth}px; vertical-align: middle; text-align: center; width: ${ScaledWidth}px; line-height: ${ScaledFontPX}px;color: ${LabelColor};\">{{{Label|}}}</div>";

		}
		return $retv;
	}
		
    function mapLeader( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Type');
		
		// Cache local arguments
		$Type = $this->args['Type'];
		$Race = $this->args['Race'];
		$Scale = $this->args['Scale'];
		$Format = $this->args['Format'];
		
    $retv = '';
    
		$tmp = $this->_GetLeftTop();
		
		if(strlen($Race) > 0)
			$retv .= $this->_mapRaceLeaderHTML($Race, $Type, $this->Left, $this->Top, $Scale, $Format);
		else $retv.= $this->_mapMiniLeaderHTML($Type, $this->Left, $this->Top, $Scale, $Format);

		return $retv;
		
	}

    function mapCC( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Race');
		
		// Cache local arguments
		$Race = $this->args['Race'];
		$Scale = $this->args['Scale'];
		$Format = $this->args['Format'];
		// _mapCC
		$this->_GetLeftTop();
		
		$Width= 100;
		$Height= 88;
		
		$this->Left -= 50;
		$this->Top -= 44;
		
		$ScaledWidth = $Width * $Scale;
		
		return $this->_mapDivHTML($this->Left, $this->Top, 1, "http://www.ti3wiki.org/wikimap/${Scale}/CC-${Race}.${Format}", $Scale);
	}

    function mapToken( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Type');
		
		$Type = $this->args['Type'];
		$Scale = $this->args['Scale'];
		$Format = $this->args['Format'];

		// _mapToken
		$this->_GetLeftTop();
		
		return $this->_mapTokenHTML($Type, $this->Left, $this->Top, $Scale, $Format);
	}

	function mapFlag( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Race');
		
		// Cache local arguments
		$Type = $this->args['Type'];
		$Race = $this->args['Race'];
		$Scale = $this->args['Scale'];
		$Format = $this->args['Format'];
			
		$this->_GetLeftTop();
		
		if(($Type != 'LgRnd' && $Type != 'SmRnd') || $Type == '')
			$Type = 'LgRnd';
			
		return $this->_mapFlagHTML($Type, $Race, $this->Left, $this->Top, $Scale, $Format);
	}

    function mapImg( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Link');
		
		// Cache local arguments
		$Link = $this->args['Link'];
		$Width = $this->args['Width'];
		$Height = $this->args['Height'];
		$Z = $this->args['Z'];
		$Scale = $this->args['Scale'];

		// _mapImg
		$this->_GetLeftTop();
		
		$Link = $this->args['LinkRoot'] . $Link;
		
		$keys = array_keys($this->args);
		for($i=0;$i<count($keys);$i++)
			$keys[$i] = '$' . $keys[$i];
			
		$Link = str_ireplace(	$keys
								,array_values($this->args)
								,$Link
							);

		
		return $this->_mapImgHTML($Link, $Width, $Height, $Z, $this->Left, $this->Top, $Scale);
	}

    function mapShip( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'Type');
		
		return $this->_mapCarrier(
				$this->args['Type']
				,$this->args['Color']
				,$this->args['Damaged']
				,$this->args['Fighters']
				,$this->args['GF']
				,$this->args['ST']
				,$this->args['PDS']
				,$this->args['Where']
				,$this->args['X']
				,$this->args['Y']
				,$this->args['Scale']
				,$this->args['Format']
			);
	}
	
    function mapCarrier( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args);
		
		return $this->_mapCarrier(
				'Carrier'
				,$this->args['Color']
				,$this->args['Damaged']
				,$this->args['Fighters']
				,$this->args['GF']
				,$this->args['ST']
				,$this->args['PDS']
				,$this->args['Where']
				,$this->args['X']
				,$this->args['Y']
				,$this->args['Scale']
				,$this->args['Format']
			);
	}
    function mapWarsun( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args);
		
		return $this->_mapCarrier(
				'Warsun'
				,$this->args['Color']
				,$this->args['Damaged']
				,$this->args['Fighters']
				,$this->args['GF']
				,$this->args['ST']
				,$this->args['PDS']
				,$this->args['Where']
				,$this->args['X']
				,$this->args['Y']
				,$this->args['Scale']
				,$this->args['Format']
			);
	}
	
    function mapDestroyer( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args);
		
		return $this->_mapCarrier(
				'Destroyer'
				,$this->args['Color']
				,$this->args['Damaged']
				,$this->args['Fighters']
				,$this->args['GF']
				,$this->args['ST']
				,$this->args['PDS']
				,$this->args['Where']
				,$this->args['X']
				,$this->args['Y']
				,$this->args['Scale']
				,$this->args['Format']
			);
	}

	function mapCruiser( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args);
		
		return $this->_mapCarrier(
				'Cruiser'
				,$this->args['Color']
				,$this->args['Damaged']
				,$this->args['Fighters']
				,$this->args['GF']
				,$this->args['ST']
				,$this->args['PDS']
				,$this->args['Where']
				,$this->args['X']
				,$this->args['Y']
				,$this->args['Scale']
				,$this->args['Format']
			);
	}

	function mapDreadnaught( &$parser )
	{
		$args = func_get_args();
		$this->_parseNamedArguments($args);
		
		return $this->_mapCarrier(
				'Dreadnaught'
				,$this->args['Color']
				,$this->args['Damaged']
				,$this->args['Fighters']
				,$this->args['GF']
				,$this->args['ST']
				,$this->args['PDS']
				,$this->args['Where']
				,$this->args['X']
				,$this->args['Y']
				,$this->args['Scale']
				,$this->args['Format']
			);
	}

	private function _mapCarrier($Type, $Color, $Damaged, $Fighters, $GF, $ST, $PDS, $Where, $X, $Y, $Scale, $Format)
	{
		$this->_GetLeftTop();
		
		$Left = $this->Left;
		$Top = $this->Top;

		$retv = $this->_mapUnitHTML( $Type, 1, false, $Color, $Damaged, $Left, $Top, $Scale, $Format);
		
//		$Left = self::$imgWidth[$Type] / 2;
		if($GF > 0 || $ST > 0)
		{
			$retv .= $this->_mapGFHTML( 	$GF
											,$ST
											,$Color 
											,$Left + (self::$imgWidth[$Type]/2) + (self::$imgWidth['GF']/2) 
											,$Top - 30 
											,$Scale 
											,$Format
										);
		}
		
		if($Fighters > 0)
		{
			$retv .= $this->_mapUnitHTML( 	'Fighter' 
											,$Fighters 
											,($Fighters > 1) 
											,$Color 
											,'' 
											,$Left + (self::$imgWidth[$Type]/2) + (self::$imgWidth['Fighter']/2) 
											,$Top + 30 
											,$Scale 
											,$Format
										);
		}
		
//		$Left -= self::$imgWidth[$Type] + ($imgWidth['PDS']/2);
		if($PDS > 6) $PDS = 6;
		for($i=0;$i<$PDS;$i++)
//		if($PDS > 0)
		{
			$retv .= $this->_mapUnitHTML( 	'PDS' 
											,1 
											,false 
											,$Color 
											,'' 
											,$Left - (self::$imgWidth[$Type]/2) - (self::$imgWidth['PDS']/2)
											,$Top - (self::$imgHeight[$Type]/2) + ((self::$imgHeight['PDS'] + 5)*$i) 
											,$Scale 
											,$Format
										);
		}
		
		
		return $retv;
	}
	
	private function _mapRaceLeaderHTML($Race, $Type, $Left, $Top, $Scale, $Format)
	{
		$Width= 120;
		$Height= 91;
		
		$Left -= 60;
		$Top -= 45;
		
		$ScaledWidth = $Width * $Scale;
		
		return $this->_mapDivHTML($Left, $Top, 1, "http://www.ti3wiki.org/wikimap/${Scale}/Leader-${Race}-${Type}.${Format}", $Scale);		
	}

	private function _mapMiniLeaderHTML($Type, $Left, $Top, $Scale, $Format)
	{
		$Width= 30;
		$Height= 30;
		
		$Left -= 15;
		$Top -= 15;
		
		$ScaledWidth = $Width * $Scale;
		
		return $this->_mapDivHTML($Left, $Top, 3, "http://www.ti3wiki.org/wikimap/${Scale}/MiniLeader-${Type}.${Format}", $Scale);		
	}
	
	private function _mapFlagHTML($Type, $Race, $Left, $Top ,$Scale, $Format)
	{
		$Width = self::$imgWidth[$Type];
		$Height = self::$imgHeight[$Type];
		
		$ScaledWidth =  $Width * $Scale;
				
		$retv .= $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), 1, "http://www.ti3wiki.org/wikimap/${Scale}/Flag-${Type}-${Race}.${Format}", $Scale);
		
		return $retv;
	}

	private function _mapTokenHTML($Type, $Left, $Top ,$Scale, $Format)
	{
		$Width = self::$imgWidth[$Type];
		$Height = self::$imgHeight[$Type];
		
		$ScaledWidth =  $Width * $Scale;
				
		$retv = $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), 1, "http://www.ti3wiki.org/wikimap/${Scale}/Token-${Type}.${Format}", $Scale);
		
		return $retv;
	}

	private function _mapImgHTML($Link, $Width, $Height, $Z, $Left, $Top, $Scale)
	{
		return $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), $Z, $Link, $Scale);
	}

	private function _mapArtifactHTML($Color, $Left, $Top ,$Scale, $Format)
	{
		$Width = 103;
		$Height = 97;
		
		$ScaledWidth =  $Width * $Scale;
				
		$retv = $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), 1, "http://www.ti3wiki.org/wikimap/${Scale}/Artifact-${Color}.${Format}", $Scale);
		
		return $retv;
	}

	private static $DSList = array ( 'Biohazard','Radiation','Hostile_Locals', 'Lazax_Survivors', 'Settlers', 'Technological_Society','Natural_Wealth','Industrial_Society','Peaceful_Annexation','Wormhole_Discovery','Native_Intelligence','Hidden_Factory','Hostage_Situation','Automated_Defense_System','Fighter_Ambush');

	private function _mapDSHTML($Type, $Left, $Top ,$Scale, $Format)
	{
		$DS_Image = $Type;
		
		$DS = explode('-',$Type);
		foreach(self::$DSList as $i)
		{
			if(strncasecmp($i,$DS[0],strlen($DS[0]))==0)
			{
				$DS_Image = $i;
				if(count($DS)>1)
					$DS_Image .= ('-' . $DS[1]);
				break;
			}
		};
		
		$Width = 85;
		$Height = 85;
		
		$ScaledWidth =  $Width * $Scale;
				
		$retv .= $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), 1, "http://www.ti3wiki.org/wikimap/${Scale}/DistantSuns-${DS_Image}.${Format}", $Scale);
		
		return $retv;
	}
	
	private function _mapGFHTML($GF, $ST, $Color, $Left, $Top, $Scale, $Format)
	{
		$retv = $this->_mapUnitHTML('GF', $GF, true, $Color, '', $Left, $Top, $Scale, $Format);
		
		if($ST > 0)
		{
			$Width = 48;
			$Height = 57;
			
			$ScaledWidth = $Width * $Scale;
			
			$Left -= ($Width/2);
			
			$Content = "http://www.ti3wiki.org/wikimap/${Scale}/Unit-GF-ShockTrooperFlag.${Format}";
			
			$retv .= $this->_mapDivHTML($Left, $Top - ($Height / 2), 2, $Content, $Scale);
			
			$retv .= $this->_mapLabelHTML($ST, 50, $Left, $Top - 40, 2, $Scale);
			
		}
		
		return $retv;
	}
	
	private function _mapUnitHTML($Type, $Quantity, $ShowQuantity, $Color, $Damaged, $Left, $Top, $Scale, $Format)
	{
		$Width = self::$imgWidth[$Type];
		$Height = self::$imgHeight[$Type];
		
		$ScaledWidth =  $Width * $Scale;
		
//		$Top -= ($Height/2);
//		$Left -= ($Width/2);
		
		$Content = "http://www.ti3wiki.org/wikimap/${Scale}/Unit-${Color}-${Type}.${Format}";
		
		$retv = $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), 2, $Content , $Scale);
		
		if($ShowQuantity)
			$retv .= $this->_mapLabelHTML($Quantity, 60, $Left + ($Width/2), $Top, 2, $Scale);
		
		if(strlen($Damaged) > 0 && $Damaged != 0)
		{
			$Width = 100;
			$Height = 100;
			
			$Content = "http://www.ti3wiki.org/wikimap/${Scale}/Unit-Damage${Damaged}.${Format}";
			$retv .= $this->_mapDivHTML($Left - ($Width/2), $Top - ($Height/2), 2, $Content, $Scale);
		}
		
		return $retv;
	}
		
	private function _mapLabelHTML($Label, $FontPX, $Left, $Top, $Z, $Scale)
	{
		$Top -= ($FontPX/2);
		$ScaledFontPX = $FontPX * $Scale;
		
		// Compensate for drift downward as font size decreases
		$Left = ($Left * $Scale);
		$XDrift = (0.5/$Scale);
		$Left += $XDrift;
		
		$Top = ($Top * $Scale) + ($this->args['YOffset']);
		$Factor = 18/$FontPX;
		$YDrift = ($Factor/$Scale) + ($Factor * $Scale);
		$Top += $YDrift;

		$LabelColor = $this->args['LabelColor'];
		
		return "<div style=\"position: absolute; left: ${Left}px; top: ${Top}px; z-index: ${Z};border-style: none; background-color: transparent;font-weight: bold; color: ${LabelColor}; font-size: ${ScaledFontPX}px;line-height: ${ScaledFontPX}px\">${Label}</div>";	
	}
	
	private function _mapDivHTML($Left, $Top, $Z, $Content, $Scale)
	{
		$Left *= $Scale;
		$Top = ($Top * $Scale) + $this->args['YOffset'];
		
		if(array_key_exists($Content, $this->redirects))
			$Content = $this->redirects[$Content];

			return "<div style=\"position: absolute; left: ${Left}px; top: ${Top}px; z-index: ${Z};\">${Content}</div>";
	}
	
	private static $includes = array();
	
	function mapInclude( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'PBeM_Name');
		
		//Cache local arguments
		$Page = $this->args['Page'];
		$PBeM_Name = $this->args['PBeM_Name'];
		
		if($PBeM_Name != '')
			$Page = $PBeM_Name . '_PBeM_WikiMap_Include';
			
		if(!self::$includes[$Page])
		{		
			$FullPageName = 'Template:' . $Page;
			$title = Title::newFromText( $FullPageName );
			$pageExists = is_object( $title ) && $title->exists();
			if($pageExists)
			{
				$r = Revision::newFromTitle($title);
				if(is_object($r))
					$retv .= $r->getText();
				self::$includes[$Page] = true;
				$retv .= '{{' . $Page . '}}';
			}
		}
		
		return $retv;
	}
	
    function TI3WikiMap( &$parser )
	{
		// Parse arguments
		$args = func_get_args();
		$this->_parseNamedArguments($args, 'PBeM_Name');

		// Cache local arguments
		$PBeM_Name = $this->args['PBeM_Name'];
		$Width = $this->args['Width'];
		$Height = $this->args['Height'];
		$ShowNumbers = $this->args['ShowNumbers'];
		$Scale = $this->args['Scale'];
		$SaveMap = $this->args['SaveMap'];
		$ScaleLinks = $this->args['ScaleLinks'];
		$BrowserWarning = $this->args['BrowserWarning'];
		$PageExistsXYLinks = $this->args['PageExistsXYLinks'];
		$PageMissingXYLinks = $this->args['PageMissingXYLinks'];
		$TileImageLinks = $this->args['TileImageLinks'];
		$HelpIncludeLinks = $this->args['HelpIncludeLinks'];
		
    $retv = '';
    
		if(!$ShowNumbers)
		{
			$PageExistsXYLinks = 0;
			$PageMissingXYLinks = 0;
		}
			
		if($SaveMap)
		{
			$ScaleLinks = 0;
			$BrowserWarning = 0;
			$PageExistsXYLinks = 0;
			$PageMissingXYLinks = 0;
			$TileImageLinks = 0;
			$HelpIncludeLinks = 0;
		}
		
		// _TI3WikiMap
		if($Width > 17)
			$Width = 17;
		if($Height > 17)
			$Height = 17;
			
		$WidthPX = $Width * 432 * $Scale;
		$HeightPX = (($Height+0.5) * 376 * $Scale) + $this->args['YOffset'];
		
		$retv .= "	
<div style=\"position: relative\">
	<table style=\"border-style: none;\">
		<tr>
			<td style=\"vertical-align: top; width: ${WidthPX}px; height: ${HeightPX}px;\">";
		
		if($ScaleLinks)
			$retv .= "	
				<div align=\"center\">
					<table class=\"ti3pbem\">
						<tr>
							<td width=\"100\">[[${PBeM_Name}_PBeM_Map|25%]]</td>
							<td width=\"100\">[[${PBeM_Name}_PBeM_Map:50%|50%]]</td>
							<td width=\"100\">[[${PBeM_Name}_PBeM_Map:100%|100%]]</td>
						</tr>
					</table>
				</div><br>\n";
					
// This is more efficient but causes problem with subst:
//		self::$mapDefaultArgs['Scale'] = $Scale;
		$retv .= '{{#mapSet:Scale=' . $Scale . '}}';

		for($x=0; $x<$Width; $x++)
		{
			for($y=0; $y<$Height;$y++)
			{
				$PX = $x * 324 * $Scale;
				$PY = (($y * 376) + (($x % 2 > 0) ? 0 : 188)) * $Scale;

				$Link = "${PBeM_Name}_PBeM_WikiMap:" . $x . ',' . $y;
				$FullLink = "Template:${Link}";
				
				if($TileImageLinks)
					$retv .= "{{#mapSet:ImageLink=${FullLink}}}\n";
//					self::$mapDefaultArgs['ImageLink'] = $FullLink;

				$retv .= "				<div style=\"position: absolute; left: ${PX}px; top: ${PY}px;\">";
				
				$title = Title::newFromText( $FullLink );
				$pageExists = is_object( $title ) && $title->exists();
				if($pageExists)
				{
					
					$r = Revision::newFromTitle($title);
					if(is_object($r))
					{
						$retv .= $r->getText();
						if(!$SaveMap)
							$parser->mOutput->addTemplate($title, $title->getArticleID(), $r->getID());
					};
/*					if(!$SaveMap)
						$retv .= '					{{' . $Link . '}}';
					else
					{
						$r = Revision::newFromTitle($title);
						if(is_object($r))
							$retv .= $r->getText();
					}*/
				}

				
				if(		($pageExists && $PageExistsXYLinks) 
					|| (!$pageExists && $PageMissingXYLinks))
					$retv .= $this->_mapLabelHTML("[[${FullLink}|${x},${y}]]", 30, 284, 15, 10, $Scale);

				$retv .= '</div>
				';
			}
		}
		
		$retv .= '
			</td>
		</tr>
	</table>
</div>
';

		if($HelpIncludeLinks)
			$retv .= "	
				<br><div align=\"center\">
					<table class=\"ti3pbem\">
						<tr>
							<td width=\"100\" >[[Template:${PBeM_Name}_PBeM_WikiMap_Include|Include]]</td>
							<td width=\"100\" >[[WikiMap Help|Help]]</td>
						</tr>
					</table>
				</div><br>\n";

		if($BrowserWarning)
			$retv .= 'Note: The wiki map does not display correctly for certain older browsers. See [[WikiMap Help|help]] for details.';

		return $retv;
    }

/*	private function _parseWiki(&$parser, $data)
	{
		if(strlen($data) < 2)
			return $data;
		
		$template_calls = explode('{{', $data);
		
		// If first part of data is not a template call, just add it to the return value and remove it from array
		if($data[0] != '{' || $data[1] != '{')
		{
			$retv .= $template_calls[0];
			unset($arr[0]);
		};
		
		foreach($template_calls as $i)
		{
			$n = strlen($i);
			// If last two characters of template call are not }}
			if(	$n < 2 
				|| $i[$n-1] != '}' 
				|| $i[$n-2] != '}')
			{
				// Then just add this string to the return value and continue
				$retv .= $i;
				continue;
			}
			// Else strip last two }}
			$tmp = substr($i, 0, $n - 2);
			
			// Split string into template name and arguments at :
			$tcall = strchr($tmp, ':', true);
			$unparsed_args = strchr($tmp, ':');
			
			// If split failed then just ignore this call
			if($tname === false || $unparsed_args == false)
				continue;
			
			// Parse arguments
			$args = explode('|', $unparsed_args);
			
			// Prepend to the beginning of the argument array a pointer to the parser
			array_unshift($args, $parser);
			
			foreach($TI3WikiMapHooks as $t)
				if(strcmp($t, $tcall))
					$retv .= call_user_func_array(array($this, $t), $args);
		}
		
		return $retv;
	}*/
}

?>