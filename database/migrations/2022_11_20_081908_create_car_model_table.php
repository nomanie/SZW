<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_model', function (Blueprint $table) {
            $table->id();
            $table->foreignId('brand_id')
                ->references('id')->on('car_brands')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->name();
            $table->timestamps();
        });
        $abarthModels = [
            'brand_id' => 1,
            'models' => ['124 Spider', '500', '595', '695', 'Grande Punto', 'Punto', 'Punto Evo']
        ];
        $acuraModels = [
            'brand_id' => 2,
            'models' => ['CL', 'CSX', 'EL', 'Integra', 'MDX', 'NSX', 'RDX', 'RL', 'RSX', 'SLX', 'TL', 'TSX', 'Vigor']
        ];
        $audiModels = [
            'brand_id' => 3,
            'models' => ['100', '200', '5000', '80', '90', 'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8', 'Allroad', 'E-tron', 'Q2', 'Q3', 'Q4', 'Q5', 'Q7', 'Q8', 'Quattro', 'R8', 'S1 (1984)', 'TT', 'V8']
        ];
        $alfaModels = [
            'brand_id' => 4,
            'models' => ['1300-Junior', '145', '146', '147', '155', '156', '159', '164', '166', '2000', '33', '4C', '75', '8C Competizione', 'Brera', 'Giulia', 'Giulietta Nuova', 'GT', 'GTV', 'MiTo', 'Spider', 'Sprint', 'Stelvio', 'Tonale']
        ];
        $alpineModels = [
            'brand_id' => 5,
            'models' => ['110']
        ];
        $andoriaModels = [
            'brand_id' => 6,
            'models' => ['Gazela']
        ];
        $amModels = [
            'brand_id' => 7,
            'models' => ['Cygnet', 'DB5', 'DB7', 'DB9', 'DBS', 'Rapide', 'V12 Vanquish', 'V12 Vantage', 'V8 Vantage']
        ];
        $autobianchiModels = [
            'brand_id' => 8,
            'models' => ['A112', 'Bianchia', 'Y10']
        ];
        $bentleyModels = [
            'brand_id' => 9,
            'models' => ['Arnage', 'Azure', 'Bentayga', 'Brooklands', 'Continental', 'Mulsanne']
        ];
        $bmwModels = [
          'brand_id' => 10,
          'models' => ['600', 'i3', 'i4', 'i7', 'i8', 'iX', 'iX3', 'Seria 02', 'Seria 1', 'Seria 2', 'Seria 3', 'Seria 4', 'Seria 5', 'Seria 6', 'Seria 7', 'Seria 8', 'X1', 'X2', 'X3', 'X4', 'X5', 'X6', 'X7', 'Z1', 'Z3', 'Z4', 'Z8']
        ];
        $cadillacModels = [
            'brand_id' => 11,
            'models' => ['BLS', 'Catera', 'CTS', 'DeVille', 'DTS', 'Eldorado', 'Escalade', 'Fleetwood', 'SeVille', 'SRX', 'STS', 'XLR']
        ];
        $chevroletModels = [
            'brand_id' => 12,
            'models' => ['Alero', 'Astro', 'Avalanche', 'Aveo', 'Beretta', 'Blazer', 'Camaro', 'Caprice Classic', 'Captiva', 'Cavalier', 'Corsica', 'Corvette', 'Cruze', 'Epica', 'Evanda', 'Express', 'G20', 'G30', 'Gladiator', 'HHR', 'Impala', 'Kalos', 'Lacetti', 'Lumina', 'Malibu', 'Matiz', 'Monte Carlo', 'Nubira', 'Orlando', 'Rezzo', 'S-10', 'Silverado', 'Spark', 'Spectrum', 'Sprint', 'Suburban', 'Tacuma', 'Tahoe', 'Tracker', 'TrailBlazer', 'Trax', 'Venture', 'Volt']
        ];
        $chryslerModels = [
            'brand_id' => 13,
            'models' => ['300C', '300M', 'Aspen', 'Cirrus', 'Concorde', 'Crossfire', 'Daytona', 'Grand Voyager', 'Intrepid', 'Laser', 'LE Baron', 'LHS', 'Neon', 'Pacifica', 'PT Cruiser', 'Saratoga', 'Sebring', 'Stratus', 'Town & Country', 'Vision', 'Voyager']
        ];
        $citroenModels = [
            'brand_id' => 14,
            'models' => ['2CV', 'AMI', 'AX', 'Axel', 'Berlingo', 'BL 11', 'BX', 'C-Crosser', 'C-Elysee', 'C-Zero', 'C1', 'C15', 'C2', 'C25', 'C3', 'C3 Aircross ', 'C3 Picasso', 'C4', 'C4 Aircross', 'C4 Cactus', 'C4 Picasso', 'C4 Spacetourer', 'C5', 'C5 Aircross', 'C5 X', 'C6', 'C8', 'CX', 'DS', 'Evasion', 'Grand C4 Picasso', 'GS', 'GSA', 'Jumper', 'Jumpy', 'Nemo', 'Saxo', 'SM', 'Spacetourer', 'Visa', 'Xantia', 'XM', 'Xsara', 'Xsara Picasso', 'ZX']
        ];
        $cupraModels = [
            'brand_id' => 15,
            'models' => ['Ateca', 'Born', 'Formentor', 'Leon']
        ];
        $daciaModels = [
            'brand_id' => 16,
            'models' => ['1100', '1300', '1304', '1305 Pick-up', '1307', '1310', '1310p', '1400', '1410', 'Dokker', 'Duster', 'Jogger', 'Lodgy', 'Logan', 'Nova 523', 'Nova 524', 'Sandero', 'Spring']
        ];
        $daewooModels = [
            'brand_id' => 17,
            'models' => [ 'Chairman', 'Damas', 'Espero', 'Evanda', 'Honker', 'Kalos', 'Korando', 'Lanos', 'Leganza', 'Lublin', 'Matiz', 'Musso', 'Nexia', 'Nubira', 'Rezzo', 'Tacuma', 'Tico']
        ];
        $dmcModels = [
            'brand_id' => 18,
            'models' => []
        ];
        $dodgeModels = [
            'brand_id' => 19,
            'models' => ['Avenger', 'B 250', 'Caliber', 'Caravan', 'Challenger', 'Charger', 'Daytona', 'Durango', 'Dynasty', 'Intrepid', 'Journey', 'Magnum', 'Neon', 'Nitro', 'Ram', 'Shadow', 'Spirit', 'Stealth', 'Stratus', 'Viper']
        ];
        $dsModels = [
            'brand_id' => 20,
            'models' => ['3', '3 Crossback', '4', '5', '7', '9']
        ];
        $ferrariModels = [
            'brand_id' => 21,
            'models' => ['360', '430', '456 GTA', '458 Italia', '550 Barcheta', '575M Maranello', '599 GTB Fiorano', '612 Scaglietti', 'California', 'Enzo', 'Testarossa']
        ];
        $fiatModels = [
            'brand_id' => 22,
            'models' => ['124', '124 Spider', '125', '125p', '126p "Maluch"', '127', '128', '130', '131', '132', '133', '500', '500L', '500X', '600', '850', 'Albea', 'Argenta', 'Barchetta', 'Bertone X1/9', 'Brava', 'Bravo', 'Cinquecento', 'Coupe', 'Croma', 'Doblo', 'Ducato', 'Fiorino', 'Freemont', 'Fullback', 'Idea', 'Linea', 'Marea', 'Multipla', 'Palio', 'Panda', 'Punto', 'Qubo', 'Regata', 'Ritmo', 'Scudo', 'Sedici', 'Seicento', 'Siena', 'Stilo', 'Strada', 'Talento', 'Tempra', 'Tipo', 'Ulysse', 'Uno']
        ];
        $fordModels = [
            'brand_id' => 23,
            'models' => ['Aerostar', 'Aspire', 'B-MAX', 'Bronco', 'C-MAX', 'Capri', 'Contour', 'Cougar', 'Courier', 'Crown Victoria', 'Econoline', 'Econovan', 'Ecosport', 'Edge', 'Edge Vignale', 'Escape', 'Escort', 'Escort USA', 'Excursion', 'Expedition', 'Explorer', 'Express', 'Falcon', 'Festiva', 'Fiesta', 'Fiesta Vignale', 'Flex', 'Focus', 'Focus Vignale', 'Freestar', 'Fusion', 'Galaxy', 'Granada', 'GT', 'Ka', 'Ka Plus', 'Kuga', 'Kuga Vignale', 'LTD', 'Maverick', 'Mondeo', 'Mondeo Vignale', 'Mustang', 'Orion', 'Probe', 'Puma', 'Ranger', 'S-Max', 'S-Max Vignale', 'Scorpio', 'seria F', 'Sierra', 'Taunus', 'Taurus', 'Tempo', 'Thunderbird', 'Tourneo Connect', 'Tourneo Courier', 'Tourneo Custom', 'Transit', 'Transit Connect', 'Transit Courier', 'Transit Custom', 'Windstar']
        ];
        $fsoModels = [
            'brand_id' => 24,
            'models' => ['1500', 'Lanos', 'Lublin', 'Matiz', 'Polonez', 'Warszawa', 'Żuk']
        ];
        $fusoModels = [
            'brand_id' => 25,
            'models' => []
        ];
        $gazModels = [
            'brand_id' => 26,
            'models' => ['21', '24', '69', 'Gazela', 'Sobol']
        ];
        $hondaModels = [
            'brand_id' => 27,
            'models' => ['Accord', 'City', 'Civic', 'Concerto', 'CR-V', 'CR-Z', 'CRX', 'e', 'Element', 'FR-V', 'HR-V', 'Insight', 'Integra', 'Jazz', 'Legend', 'Logo', 'NSX', 'Odyssey', 'Pilot', 'Prelude', 'Ridgeline', 'S 2000', 'Shuttle', 'Stream', 'Vamos']
        ];
        $hummerModels = [
            'brand_id' => 28,
            'models' => ['H1', 'H2', 'H3']
        ];
        $hyundaiModels = [
            'brand_id' => 29,
            'models' => ['Accent', 'Atos', 'Bayon', 'Coupe', 'Elantra', 'Equus', 'Excel', 'Galloper', 'Genesis', 'Genesis Coupe', 'Getz', 'Grand Santa Fe', 'Grandeur', 'H1', 'H100', 'H200', 'i10', 'i20', 'i30', 'i40', 'IONIQ', 'IONIQ 5', 'ix20', 'ix35', 'ix55', 'Kona', 'Lantra', 'Matrix', 'Pony', 'Santa Fe', 'Santamo', 'Scoupe', 'Sonata', 'Starex', 'Stellar', 'Terracan', 'Tiburon', 'Trajet', 'Tucson', 'Veloster', 'XG']
        ];
        $ineosModels = [
            'brand_id' => 30,
            'models' => ['Grenadier']
        ];
        $infinitiModels = [
            'brand_id' => 31,
            'models' => ['EX', 'FX', 'G', 'M', 'Q30', 'Q50', 'Q60', 'Q70', 'QX', 'QX30', 'QX50', 'QX60', 'QX70']
        ];
        $instrallModels = [
            'brand_id' => 32,
            'models' => ['Honker 2000', 'Lublin']
        ];
        $isuzuModels = [
            'brand_id' => 33,
            'models' => ['Amigo', 'Axiom', 'Campo', 'D-Max', 'Gemini', 'Midi', 'MU', 'Piazza', 'Rodeo', 'Stylus', 'Trooper']
        ];
        $ivecoModels = [
            'brand_id' => 34,
            'models' => ['Daily', 'Turbo Daily 35-12']
        ];
        $izeraModels = [
            'brand_id' => 35,
            'models' => ['T100', 'Z100']
        ];
        $jaguarModels = [
            'brand_id' => 36,
            'models' => ['E-Pace', 'E-Type', 'F-Pace', 'F-Type', 'I-Pace', 'S-Type', 'X-Type', 'XE', 'XF', 'XJ', 'XJ8', 'XJR', 'XJS', 'XK', 'XK8', 'XKR']
        ];
        $jeepModels = [
            'brand_id' => 37,
            'models' => ['Cherokee', 'Commander', 'Compass', 'Gladiator', 'Grand Cherokee', 'Liberty', 'Patriot', 'Renegade', 'Wagoneer', 'Wrangler']
        ];
        $kawasakiModels = [
            'brand_id' => 38,
            'models' => []
        ];
        $kiaModels = [
            'brand_id' => 39,
            'models' => ['Besta', 'Carens', 'Carnival', 'Ceed', 'Cerato', 'Clarus', 'Enterprise', 'EV6', 'Joice', 'K2900', 'Magentis', 'Niro', 'Opirus', 'Optima', 'Picanto', 'Pregio', 'Pride', 'Proceed', 'Retona', 'Rio', 'Rocsta', 'Sedona', 'Sephia', 'Shuma', 'Sorento', 'Soul', 'Spectra', 'Sportage', 'Stinger', 'Stonic', 'Towner', 'Venga', 'XCeed']
        ];
        $ladaModels = [
            'brand_id' => 40,
            'models' => ['110', '2101', '2102', '2103', '2104', '2105', '2106', '2107', 'Kalina', 'Niva', 'OKA', 'Samara']
        ];
        $lamborghiniModels = [
            'brand_id' => 41,
            'models' => ['Aventador', 'Countach', 'Diablo', 'Gallardo', 'Huracan', 'Miura', 'Murcielago', 'Urus', 'Veneno']
        ];
        $lanciaModels = [
            'brand_id' => 42,
            'models' => ['Dedra', 'Delta', 'Kappa', 'Lybra', 'Musa', 'Phedra', 'Prisma', 'Stratos', 'Thema', 'Thesis', 'Voyager', 'Ypsilon', 'Zeta']
        ];
        $lrModels = [
            'brand_id' => 43,
            'models' => ['Defender', 'Discovery', 'Discovery Sport', 'Freelander', 'Range Rover', 'Range Rover Evoque', 'Range Rover Sport', 'Range Rover Velar']
        ];
        $ldvModels = [
            'brand_id' => 44,
            'models' => ['Maxus']
        ];
        $levcModels = [
            'brand_id' => 45,
            'models' => ['TX Shuttle', 'VN5', 'TX Taxi']
        ];
        $lexusModels = [
            'brand_id' => 46,
            'models' => ['CT', 'ES', 'GS', 'GX', 'HS', 'IS', 'LC', 'LS', 'LX', 'NX', 'RC', 'RX', 'RX L', 'SC', 'UX']
        ];
        $ligierModels = [
            'brand_id' => 47,
            'models' => ['JS RC', 'JS50', 'JS50L']
        ];
        $lotusModels = [
            'brand_id' => 48,
            'models' => ['Elise', 'Esprit', 'Europa', 'Evora', 'Exige S']
        ];
        $ltiModels = [
            'brand_id' => 49,
            'models' => []
        ];
        $manModels = [
            'brand_id' => 50,
            'models' => ['TGE']
        ];
        $maseratiModels = [
            'brand_id' => 51,
            'models' => ['Biturbo', 'Coupe', 'Ghibli', 'Gran Cabrio', 'GranSport', 'GranTurismo', 'Levante', 'MC12', 'Quattroporte', 'Spyder']
        ];
        $maybachModels = [
            'brand_id' => 52,
            'models' => ['57', '62']
        ];
        $mazdaModels = [
            'brand_id' => 53,
            'models' => ['121', '2', '3', '323', '5', '6', '626', '929', 'CX-3', 'CX-30', 'CX-5', 'CX-60', 'CX-7', 'CX-8', 'CX-9', 'Demio', 'E2000', 'Millenia', 'MPV', 'MX-3', 'MX-30', 'MX-5', 'MX-6', 'Premacy', 'Protege', 'RX-7', 'RX-8', 'Seria B', 'Tribute', 'Xedos']
        ];
        $maxusModels = [
            'brand_id' => 54,
            'models' => ['Euniq 6', 'Euniq 5 MPV', 'eT90 Pickup']
        ];
        $mercedesModels = [
            'brand_id' => 55,
            'models' => ['190', 'AMG GT', 'Citan', 'CL', 'CLA', 'CLC', 'CLK', 'CLS', 'EQA', 'EQB', 'EQC', 'EQE', 'EQS', 'EQV', 'GLA', 'GLB', 'GLC', 'GLE', 'GLK', 'GLS', 'Klasa A', 'Klasa B', 'Klasa C', 'Klasa E', 'Klasa G', 'Klasa GL', 'Klasa M', 'Klasa R', 'Klasa S', 'Klasa T', 'Klasa V', 'Klasa X', 'Maybach GLS', 'Maybach S', 'MB-100', 'SL', 'SLC', 'SLK', 'SLR McLaren', 'SLS AMG', 'Sprinter', 'Strich 8', 'Transporter T1', 'Vaneo', 'Viano', 'Vito', 'W108/109', 'W110', 'W111', 'W123', 'W124']
        ];
        $mclarenModels = [
            'brand_id' => 56,
            'models' => ['F1', 'F1 GTR', 'F1 LM', 'MP4-12C', 'X-1', '12C', 'P1', '650S', 'Speedtail', '570S', 'Sabre', 'Solus', 'Artura', '720S', 'GT', 'Elva', 'Senna']
        ];
        $mgModels = [
            'brand_id' => 57,
            'models' => ['6', 'F', 'MG3', 'TF', 'ZR', 'ZS', 'ZT']
        ];
        $miniModels = [
            'brand_id' => 61,
            'models' => ['Cabrio', 'Clubman', 'Countryman', 'Coupe', 'Mini', 'One', 'Paceman', 'Roadster']
        ];
        $mitsubishiModels = [
            'brand_id' => 62,
            'models' => [ '3000GT', 'ASX', 'Carisma', 'Colt', 'Cordia', 'Diamante', 'Eclipse', 'Eclipse Cross', 'Endeavor', 'FTO', 'Galant', 'Grandis', 'i-MiEV', 'L200', 'L300', 'L400', 'Lancer', 'Lancer Evolution', 'Mirage', 'Montero', 'Outlander', 'Pajero', 'Pajero Sport', 'Santamo', 'Sapporo', 'Sigma', 'Space Gear', 'Space Runner', 'Space Star', 'Space Star (1998)', 'Space Wagon', 'Starion']
        ];
        $nissanModels = [
            'brand_id' => 63,
            'models' => [ '100NX', '200SX', '280ZX', '300ZX', '350Z', '370Z', 'Almera', 'Almera Tino', 'Altima', 'Ariya', 'Bluebird', 'Cherry', 'Cube', 'Evalia', 'GT-R', 'Interstar', 'Juke', 'Kubistar', 'Laurel', 'Leaf', 'Maxima', 'Micra', 'Murano', 'Navara', 'Note', 'NP300', 'NV200', 'Pathfinder', 'Patrol', 'Pick Up', 'Pixo', 'Prairie', 'President', 'Primastar', 'Primera', 'Pulsar', 'Qashqai', 'Quest', 'Sentra', 'Serena', 'Skyline', 'Stanza', 'Sunny', 'Teana', 'Terrano', 'Tiida', 'Titan', 'Townstar', 'Trade', 'Urvan', 'Vanette', 'X-Trail', 'Xterra']
        ];
        $opelModels = [
            'brand_id' => 64,
            'models' => []
        ];
        $peugeotModels = [
            'brand_id' => 65,
            'models' => []
        ];
        $piaggioModels = [
            'brand_id' => 66,
            'models' => []
        ];
        $pFiatModels = [
            'brand_id' => 67,
            'models' => []
        ];
        $porscheModels = [
            'brand_id' => 68,
            'models' => []
        ];
        $ramModels = [
            'brand_id' => 69,
            'models' => []
        ];
        $renaultModels = [
            'brand_id' => 70,
            'models' => []
        ];
        $renaultTruckModels = [
            'brand_id' => 71,
            'models' => []
        ];
        $rrModels = [
            'brand_id' => 72,
            'models' => []
        ];
        $roverModels = [
            'brand_id' => 73,
            'models' => []
        ];
        $saabModels = [
            'brand_id' => 74,
            'models' => []
        ];
        $seatModels = [
            'brand_id' => 75,
            'models' => []
        ];
        $seresModels = [
            'brand_id' => 76,
            'models' => []
        ];
        $skodaModels = [
            'brand_id' => 77,
            'models' => []
        ];
        $skywellModels = [
            'brand_id' => 78,
            'models' => []
        ];
        $smartModels = [
            'brand_id' => 79,
            'models' => []
        ];
        $ssangModels = [
            'brand_id' => 80,
            'models' => []
        ];
        $subaruModels = [
            'brand_id' => 81,
            'models' => []
        ];
        $suzukiModels = [
            'brand_id' => 82,
            'models' => []
        ];
        $tataModels = [
            'brand_id' => 83,
            'models' => []
        ];
        $teslaModels = [
            'brand_id' => 84,
            'models' => []
        ];
        $toyotaModels = [
            'brand_id' => 85,
            'models' => []
        ];
        $mielecModels = [
            'brand_id' => 86,
            'models' => []
        ];
        $VolkswagenModels = [
            'brand_id' => 87,
            'models' => []
        ];
        $volvoModels = [
            'brand_id' => 88,
            'models' => []
        ];
        $zdModels = [
            'brand_id' => 89,
            'models' => []
        ];

        DB::table('car_model')->insert([
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('car_model');
    }
};
