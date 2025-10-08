<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run()
    {
        // Quiz::factory()->count(10)->create(); // Create 10 quizzes

        $quiz = Quiz::create([
            'category' => 'Shkenca Kompjuterike',
            'title' => 'Programimi i Pythonit',
            'description' => 'Ky kurs mbulon bazat e programimit në Python.',
        ]);

        $questions = [
            [
                'question' => 'Cili është simboli për një koment një-rresht në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => '#',
                    'B' => '//',
                    'C' => '/*',
                    'D' => '--',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Python mbështet multi-threading?',
                'type' => 'true-false',
                'options' => null,
                'correct_answer' => 'True',
            ],
            [
                'question' => 'Cili është lloji i të dhënave të integruar në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'String',
                    'B' => 'Integer',
                    'C' => 'List',
                    'D' => 'Të gjitha të mësipërmet',
                ]),
                'correct_answer' => 'D',
            ],
            [
                'question' => 'Cili është simboli për një string në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => '"',
                    'B' => "'",
                    'C' => "`",
                    'D' => 'Të gjitha mund të jenë të sakta',
                ]),
                'correct_answer' => 'D',
            ],
            [
                'question' => 'Python është një gjuhë e tipizuar dinamikisht?',
                'type' => 'true-false',
                'options' => null,
                'correct_answer' => 'True',
            ],
            [
                'question' => 'Cili është operatori për shtim në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => '+',
                    'B' => '-',
                    'C' => '*',
                    'D' => '/',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është rezultati i shprehjes: "5" + 2 në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => '7',
                    'B' => '52',
                    'C' => '5+2',
                    'D' => 'Error',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është një listë në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një tip i dhënash i fiksuar',
                    'B' => 'Një koleksion i renditur i elementeve',
                    'C' => 'Një lloj variabli për mbajtjen e një vlere',
                    'D' => 'Të gjitha të mësipërmet janë të sakta',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është tipi i variablit për numra të plotë në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'int',
                    'B' => 'float',
                    'C' => 'double',
                    'D' => 'decimal',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është përdorimi i funksionit "len()" në Python?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Për të përcaktuar gjatësi të një stringu',
                    'B' => 'Për të ndarë një string',
                    'C' => 'Për të krijuar një listë',
                    'D' => 'Për të shtuar elemente në një listë',
                ]),
                'correct_answer' => 'A',
            ]
        ];

        foreach ($questions as $questionData) {
            $quiz->questions()->create($questionData);
        }

        $quiz2 = Quiz::create([
            'category' => 'Shkenca Kompjuterike',
            'title' => 'Algoritmet dhe Strukturat e të Dhënave',
            'description' => 'Ky kurs mbulon bazat e algoritmeve dhe strukturave të të dhënave.',
        ]);

        $questions2 = [
            [
                'question' => 'Cili është algoritmi i përdorur për renditjen e elementeve në një listë?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Algoritmi i flluskës',
                    'B' => 'Algoritmi i Quick Sort',
                    'C' => 'Algoritmi i Merge Sort',
                    'D' => 'Të gjitha të mësipërmet',
                ]),
                'correct_answer' => 'D',
            ],
            [
                'question' => 'Cili është ndryshimi midis një liste dhe një grupi?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një grup është më i shpejtë në operacione të kërkimit',
                    'B' => 'Një listë është më e shpejtë në operacione të kërkimit',
                    'C' => 'Një grup ka një rend të fiksuar, ndërsa lista jo',
                    'D' => 'Një grup ka vetëm vlera unike',
                ]),
                'correct_answer' => 'D',
            ],
            [
                'question' => 'Cili është tipar i një strukture të të dhënave "Stack"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'LIFO (Last In First Out)',
                    'B' => 'FIFO (First In First Out)',
                    'C' => 'Shton elemente në fund dhe i heq nga fillimi',
                    'D' => 'Asnjë nga të mësipërmet',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili algoritëm përdoret për të gjetur shpejtë elementin minimal në një listë të renditur?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Algoritmi i kërkimit binar',
                    'B' => 'Algoritmi i kërkimit linear',
                    'C' => 'Algoritmi i Quick Sort',
                    'D' => 'Algoritmi i Bubble Sort',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është përdorimi i strukturës së të dhënave "Queue"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'FILO (First In Last Out)',
                    'B' => 'FIFO (First In First Out)',
                    'C' => 'LIFO (Last In First Out)',
                    'D' => 'Kërkim binar',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është algoritmi që përdor një strukturë "Hash Table"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Algoritmi i kërkimit binar',
                    'B' => 'Algoritmi i kërkimit linear',
                    'C' => 'Algoritmi i kërkimit me hasher',
                    'D' => 'Algoritmi i Quick Sort',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Cili është shembulli i një algoritmi të kërkimit rekursiv?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Algoritmi i kërkimit binar',
                    'B' => 'Algoritmi i flluskës',
                    'C' => 'Algoritmi i Quick Sort',
                    'D' => 'Algoritmi i Merge Sort',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cila është struktura e të dhënave që përdor dyqane dhe operacione të prioriteteve?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Heap',
                    'B' => 'Queue',
                    'C' => 'Stack',
                    'D' => 'Listë',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cila është karakteristika kryesore e një grafi në teorinë e grafëve?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Elementet janë të lidhura vetëm me lidhje të drejtpërdrejta',
                    'B' => 'Elementet janë të lidhura në mënyrë të drejtpërdrejtë dhe të kundërt',
                    'C' => 'Elementet janë të renditura në mënyrë të fiksuar',
                    'D' => 'Elementet janë të lidhura vetëm me lidhje jo të drejtpërdrejta',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është qëllimi i përdorimit të një strukture të të dhënave "Tree"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Për të ruajtur të dhëna të renditura hierarkikisht',
                    'B' => 'Për të mbajtur një koleksion të dhënash të pandryshueshme',
                    'C' => 'Për të shpejtuar operacionet e kërkimit',
                    'D' => 'Të gjitha të mësipërmet',
                ]),
                'correct_answer' => 'D',
            ],
        ];

        foreach ($questions2 as $questionData) {
            $quiz2->questions()->create($questionData);
        }

        $quiz3 = Quiz::create([
            'category' => 'Marketing',
            'title' => 'Marketingu Digjital',
            'description' => 'Ky kuiz mbulon bazat dhe teknikat e marketingut digjital.',
        ]);

        $questions3 = [
            [
                'question' => 'Cili është objektivi kryesor i SEO?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të rrisë trafikun organik në faqen e internetit',
                    'B' => 'Të rrisë trafikun nga reklamat paguara',
                    'C' => 'Të optimizojë përmbajtjen e rrjeteve sociale',
                    'D' => 'Të krijojë produkte të reja',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është emri i njohur për "Pay-Per-Click" (PPC) reklamat?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Reklama në rrjetet sociale',
                    'B' => 'Reklama me shpërndarje të shtuar',
                    'C' => 'Google Ads',
                    'D' => 'Email marketing',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Cili është avantazhi i përdorimit të email marketingut?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Nuk ka kosto',
                    'B' => 'Lejon personalizim të mesazheve',
                    'C' => 'Ka një audiencë të gjerë',
                    'D' => 'Të gjitha të mësipërmet',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është qëllimi i përdorimit të analitikës në marketingun digjital?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të rrisë vëllimin e shitjeve',
                    'B' => 'Të kuptojë sjelljen e konsumatorëve dhe të optimizojë strategjitë',
                    'C' => 'Të krijojë më shumë produkte',
                    'D' => 'Të krijojë mundësi për konkurrencë të drejtpërdrejtë',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një tipar i marketingut në rrjetet sociale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Shpërndarja e reklamave tradicionale',
                    'B' => 'Ndërveprimi me audiencën dhe ndihma për ndërtimin e markës',
                    'C' => 'Shitje të drejtpërdrejta nga faqet e internetit',
                    'D' => 'Të gjitha të mësipërmet',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është një "call to action" (CTA)?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një buton që inkurajon vizitorët të ndërmarrin një veprim të caktuar',
                    'B' => 'Një frazë që përshkruan shërbimin e ofruar',
                    'C' => 'Një video promovuese',
                    'D' => 'Një llogari sociale e re',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është "content marketing"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Reklama e drejtpërdrejtë në internet',
                    'B' => 'Krijimi dhe shpërndarja e përmbajtjes që tërheq dhe angazhon audiencën',
                    'C' => 'Organizimi i ngjarjeve të drejtpërdrejta',
                    'D' => 'Krijimi i ofertave speciale dhe shitjeve',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një nga format më të njohura të marketingut të përmbajtjes?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Reklamat e promovuar',
                    'B' => 'Blogjet dhe artikujt',
                    'C' => 'Ndihma e përdoruesve për reklamat',
                    'D' => 'SEO',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është "affiliate marketing"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Shitje të drejtpërdrejta përmes lidhjeve partnerë',
                    'B' => 'Marketingu përmes rrjeteve sociale',
                    'C' => 'Shpërndarja e informacionit të përmbajtjes',
                    'D' => 'Marketing përmes email-ve',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është përdorimi i marketingut të influencuesve?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Për të rritur besueshmërinë dhe angazhimin me një audiencë të gjerë',
                    'B' => 'Për të bërë reklama tradicionale',
                    'C' => 'Për të krijuar një markë të re',
                    'D' => 'Për të kryer hetime mbi konkurrencën',
                ]),
                'correct_answer' => 'A',
            ],
        ];

        foreach ($questions3 as $questionData) {
            $quiz3->questions()->create($questionData);
        }

        $quiz4 = Quiz::create([
            'category' => 'Marketing',
            'title' => 'Strategjitë e Markës dhe Konsumatorit',
            'description' => 'Ky kuiz mbulon strategjitë që lidhen me menaxhimin e markës dhe analizën e sjelljes së konsumatorëve.',
        ]);

        $questions4 = [
            [
                'question' => 'Cili është qëllimi kryesor i një strategjie të markës?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të krijojë njohuri dhe besueshmëri për markën',
                    'B' => 'Të rrisë çmimet e produkteve',
                    'C' => 'Të rrisë prodhimin',
                    'D' => 'Të organizojë ngjarje promocionale',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është një element i rëndësishëm i pozicionimit të markës?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Shmangia e konkurrencës',
                    'B' => 'Krijimi i një mesazhi të qartë dhe të dallueshëm',
                    'C' => 'Përdorimi i reklameve tradicionale',
                    'D' => 'Largimi nga zhvillimi i produkteve të reja',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është segmentimi i tregut?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Ndajja e tregut në grupe të mëdha',
                    'B' => 'Krijimi i produkteve të reja për audiencën e gjerë',
                    'C' => 'Përzgjedhja e grupeve të ndryshme për promovim të produkteve',
                    'D' => 'Krijimi i mesazheve të përgjithshme për të gjithë konsumatorët',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Cili është rol i mbajtjes së një marrëdhënieje të fortë me konsumatorët?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Për të ruajtur besnikërinë dhe për të rritur shitjet',
                    'B' => 'Për të rritur çmimin e produkteve',
                    'C' => 'Për të zhvilluar produkte të reja',
                    'D' => 'Për të rritur sa më shumë reklamat',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është parimi i "customer-centric marketing"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Dizajnimi i një produkti për një grup të caktuar konsumatorësh',
                    'B' => 'Ndjekja e konkurencës dhe imitimi i tyre',
                    'C' => 'Krijimi i fushatave reklamash që përfshijnë të gjithë konsumatorët',
                    'D' => 'Fokusimi vetëm në shitjet dhe margjinën',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë do të thotë "branding" për një kompani?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përshkrimi i produkteve dhe shërbimeve',
                    'B' => 'Ndërtimi i një identiteti të fortë dhe të njohur për konsumatorët',
                    'C' => 'Marketingu i produkteve përmes kanaleve tradicionale',
                    'D' => 'Rritja e shitjeve në mënyrë të drejtpërdrejtë',
                ]),
                'correct_answer' => 'B',
            ],
        ];

        foreach ($questions4 as $questionData) {
            $quiz4->questions()->create($questionData);
        }

        $quiz5 = Quiz::create([
            'category' => 'Ligj',
            'title' => 'E Drejta Civile',
            'description' => 'Ky kuiz mbulon pyetje të lidhura me parimet dhe rregullat e drejtësisë civile.',
        ]);
        
        $questions5 = [
            [
                'question' => 'Cila është e drejta civile që ka të bëjë me pasuritë?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'E drejta për të përdorur dhe shfrytëzuar pasurinë',
                    'B' => 'E drejta për të krijuar kontrata',
                    'C' => 'E drejta për të ndarë pasurinë',
                    'D' => 'E drejta për të ndryshuar pasuritë',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është elementi themelor i një kontrate civile?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përputhja mes dëshirës dhe vullnetit të dy palëve',
                    'B' => 'Kthimi i pasurisë',
                    'C' => 'Gjykimi në favor të një pale',
                    'D' => 'Pajtimi ndërmjet palëve',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është shkelja e detyrimeve kontraktuale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Shkelje e kushteve të kontratës',
                    'B' => 'Mungesa e firmës në kontratë',
                    'C' => 'Mospagesa e taksave',
                    'D' => 'Shkelje e ligjit penal',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë nënkuptohet me “pronë” sipas ligjit civil?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Çdo gjë që mund të kontrollohet dhe shfrytëzohet ligjërisht',
                    'B' => 'Gjendja e individëve në shoqëri',
                    'C' => 'E drejta për të ushtruar aktivitetin ekonomik',
                    'D' => 'Të drejtat e punëtorëve në një ndërmarrje',
                ]),
                'correct_answer' => 'A',
            ],
            // (Shtoni pyetje të tjera për E Drejtën Civile)
        ];
        
        foreach ($questions5 as $questionData) {
            $quiz5->questions()->create($questionData);
        }
        
        $quiz6 = Quiz::create([
            'category' => 'Ligj',
            'title' => 'E Drejta Penale',
            'description' => 'Ky kuiz mbulon pyetje të lidhura me parimet dhe rregullat e drejtësisë penale.',
        ]);
        
        $questions6 = [
            [
                'question' => 'Cili është qëllimi kryesor i ndëshkimit në të drejtën penale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të ruajë rendin dhe sigurinë shoqërore',
                    'B' => 'Të kthejë pasurinë e vjedhur',
                    'C' => 'Të ndërtojë marrëdhënie të mira ndërkombëtare',
                    'D' => 'Të ndihmojë përmirësimin ekonomik të shoqërisë',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cila është ndëshkimi që nuk përfshin burgimin në të drejtën penale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Gjobë',
                    'B' => 'Kufizimi i lirisë',
                    'C' => 'Dënimi me burgim të përjetshëm',
                    'D' => 'Përjashtimi nga shërbimi ushtarak',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është vepra penale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një veprim i kundërligjshëm i ndëshkueshëm me ligj',
                    'B' => 'Një gabim i rëndë në një marrëdhënie private',
                    'C' => 'Një veprim që ka pasoja negative për një individ',
                    'D' => 'Një kundërvajtje administrative',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është ndëshkimi për një krim të rëndë në të drejtën penale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Dënimi me burgim të përjetshëm',
                    'B' => 'Gjobë dhe burgim të përkohshëm',
                    'C' => 'Vërejtje publike',
                    'D' => 'Kufizimi i lirisë për një periudhë të caktuar',
                ]),
                'correct_answer' => 'A',
            ],
            // (Shtoni pyetje të tjera për E Drejtën Penale)
        ];
        
        foreach ($questions6 as $questionData) {
            $quiz6->questions()->create($questionData);
        }
        
        $quiz7 = Quiz::create([
            'category' => 'Ekonomi',
            'title' => 'Bazat e Ekonomisë',
            'description' => 'Ky kuiz mbulon konceptet themelore të ekonomisë, si oferta, kërkesa dhe mekanizmat e tregut.',
        ]);
        
        $questions7 = [
            [
                'question' => 'Çfarë është kërkesa në ekonomi?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Sasia e mallrave që janë të gatshme për t’u prodhuar',
                    'B' => 'Sasia e mallrave që konsumatorët janë të gatshëm të blejnë',
                    'C' => 'Sasia e mallrave që mund të prodhohen në një fabrikë',
                    'D' => 'Sasia e mallrave që ofrohen për tregti ndërkombëtare',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë ndodh me çmimin kur kërkesa për një produkt rritet?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Çmimi bie',
                    'B' => 'Çmimi qëndron i pandryshuar',
                    'C' => 'Çmimi rritet',
                    'D' => 'Çmimi ka ndikim të paqartë',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Cili është një shembull i një pasurie të pakalueshme?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një kompani që ka aksione',
                    'B' => 'Një pasuri natyrore që nuk mund të tregtohet',
                    'C' => 'Një dhuratë e dhënë nga një person',
                    'D' => 'Një borxh që mund të shlyhet',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është inflacioni?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Rritja e çmimeve të mallrave dhe shërbimeve',
                    'B' => 'Ulja e çmimeve të mallrave dhe shërbimeve',
                    'C' => 'Rritja e furnizimit me mallra',
                    'D' => 'Luhatjet në çmimet e burimeve natyrore',
                ]),
                'correct_answer' => 'A',
            ],
            // (Shtoni pyetje të tjera për Bazat e Ekonomisë)
        ];
        
        foreach ($questions7 as $questionData) {
            $quiz7->questions()->create($questionData);
        }

        $quiz8 = Quiz::create([
            'category' => 'Ekonomi',
            'title' => 'Menaxhimi i Biznesit',
            'description' => 'Ky kuiz mbulon tema të menaxhimit të biznesit, si planifikimi, strategjia dhe menaxhimi i burimeve njerëzore.',
        ]);
        
        $questions8 = [
            [
                'question' => 'Cili është qëllimi kryesor i menaxhimit të biznesit?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Makina të prodhimit të mallrave',
                    'B' => 'Të sigurohet stabiliteti financiar i biznesit',
                    'C' => 'Të kontrollohet procesi i prodhimit të mallrave',
                    'D' => 'Të krijohet një përvojë pozitive për konsumatorët',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një nga elementët kryesorë të një plani të biznesit?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Analiza e tregut dhe konkurrencës',
                    'B' => 'Rrjeti social i menaxhimit të punonjësve',
                    'C' => 'Shërbimet e marketingut dhe publicitetit',
                    'D' => 'Kostot e zhvillimit të produktit',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është roli i menaxherit të burimeve njerëzore në një biznes?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përgatitja e strategjive për marketing',
                    'B' => 'Organizimi i menaxhimit të punonjësve dhe trajnimi i tyre',
                    'C' => 'Kontrollimi i procedurave ligjore',
                    'D' => 'Monitorimi i prodhimit dhe kontrolli i burimeve',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është një analizë SWOT?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një analizë për burimet e jashtme të energjisë',
                    'B' => 'Një mjet për analizën e forcave, dobësive, mundësive dhe kërcënimeve',
                    'C' => 'Një analizë për kostot e produkteve',
                    'D' => 'Një raport për sjelljet e konsumatorëve',
                ]),
                'correct_answer' => 'B',
            ],
            // (Shtoni pyetje të tjera për Menaxhimin e Biznesit)
        ];
        
        foreach ($questions8 as $questionData) {
            $quiz8->questions()->create($questionData);
        }
        
        $quiz9 = Quiz::create([
            'category' => 'Edukimi',
            'title' => 'Edukimi Digjital',
            'description' => 'Ky kuiz mbulon konceptet e edukimit digjital, përdorimin e teknologjisë dhe e-learning.',
        ]);
        
        $questions9 = [
            [
                'question' => 'Çfarë është edukimi digjital?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përdorimi i mjeteve tradicionale për mësimdhënie',
                    'B' => 'Përdorimi i teknologjisë dhe internetit për të mësuar dhe mësimdhënë',
                    'C' => 'Mësimi nëpërmjet librave të shkruar',
                    'D' => 'Mësimi në grupe të vogla offline',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një përfitim kryesor i edukimit digjital?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Siguron mësim pa mundësi për ndërveprim',
                    'B' => 'Lejon studentët të mësojnë me ritmin e tyre',
                    'C' => 'Ofron mundësi të kufizuara për burime dhe materiale',
                    'D' => 'Zvogëlon mundësitë për ndihmën e mësuesve',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një shembull i platformave të edukimit digjital?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Google Search',
                    'B' => 'YouTube',
                    'C' => 'Khan Academy',
                    'D' => 'Instagram',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Çfarë është e-learning?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Mësimi i bazuar në teknologjinë online',
                    'B' => 'Mësimi që ofrohet vetëm në klasa fizike',
                    'C' => 'Mësimi përmes video-tapeve tradicionale',
                    'D' => 'Mësimi i bazuar në udhëzues të shkruar',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është një përfitim i përdorimit të aplikacioneve edukative në mësimdhënie?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përdorimi i shumë materialeve dhe mjeteve interaktive',
                    'B' => 'Përdorimi i metodave të vjetra dhe të pasura me letra',
                    'C' => 'Rritja e kohës së kaluar jashtë linje',
                    'D' => 'Zvogëlon mundësinë për ndihmë nga mësuesit',
                ]),
                'correct_answer' => 'A',
            ],
            // (Shtoni pyetje të tjera për Edukimin Digjital)
        ];
        
        foreach ($questions9 as $questionData) {
            $quiz9->questions()->create($questionData);
        }
        
        $quiz10 = Quiz::create([
            'category' => 'Edukimi',
            'title' => 'Teknika të Mësimdhënies Moderne',
            'description' => 'Ky kuiz mbulon teknikat dhe metodat moderne të mësimdhënies që përdoren në mjedisin arsimor.',
        ]);
        
        $questions10 = [
            [
                'question' => 'Cila është një nga teknikat më të përdorura në mësimdhënie moderne?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Mësimi me përsëritje të theksuar',
                    'B' => 'Mësimi i bazuar në projekte',
                    'C' => 'Mësimi i bazuar vetëm në leksione verbale',
                    'D' => 'Përdorimi i librave të shkruar si burimi i vetëm',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është qëllimi kryesor i mësimdhënies me projekt?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të krijohen ushtrime që mund të bëhen gjatë klasës',
                    'B' => 'Të zhvillohen aftësitë për zgjidhjen e problemeve reale',
                    'C' => 'Të fokusohet vetëm në memorimin e informacionit',
                    'D' => 'Të përgatiten studentët për provimet',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është mësimdhënia e diferencuar?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Mësimi në grup të mëdha',
                    'B' => 'Mësimi që synon të kënaqë nevojat e ndryshme të nxënësve',
                    'C' => 'Mësimi që zhvillohet vetëm në mënyrë verbale',
                    'D' => 'Mësimi i bazuar vetëm në burime tradicionale',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një shembull i përdorimit të teknologjisë në mësimdhënie?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përdorimi i mjeteve digjitale për mësim dhe vlerësim',
                    'B' => 'Shkruajtja e leksioneve në bord',
                    'C' => 'Përdorimi i libra me dorë',
                    'D' => 'Mësimi që zhvillohet vetëm me leksione',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është qëllimi i përdorimit të mësimdhënies aktive?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të zhvillohen aftësi praktike dhe bashkëpunuese në grup',
                    'B' => 'Të zhvillohen vetëm aftësitë teorike',
                    'C' => 'Të ndihmohet memorimi i materialeve',
                    'D' => 'Të përgatiten studentët për provimet e klasës',
                ]),
                'correct_answer' => 'A',
            ],
            // (Shtoni pyetje të tjera për Teknika të Mësimdhënies Moderne)
        ];
        
        foreach ($questions10 as $questionData) {
            $quiz10->questions()->create($questionData);
        }
        
        $quiz11 = Quiz::create([
            'category' => 'Ekonomi',
            'title' => 'Investimet dhe Menaxhimi i Rrezikut',
            'description' => 'Ky kuiz mbulon konceptet kryesore të investimeve dhe menaxhimit të rrezikut në sektorin financiar.',
        ]);
        
        $questions11 = [
            [
                'question' => 'Çfarë është një investim?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Përdorimi i parave për të blerë mallra',
                    'B' => 'Përdorimi i kapitalit për të fituar një kthim të mundshëm',
                    'C' => 'Këmbimi i parave për shërbime financiare',
                    'D' => 'Përdorimi i kapitalit për të paguar borxhe',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një nga metodat për menaxhimin e rrezikut në investime?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Diversifikimi',
                    'B' => 'Këmbimi i parave',
                    'C' => 'Përqendrimi i investimeve në një sektor',
                    'D' => 'Rritja e kapitalit vetëm në mënyrë të njëhershme',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është rreziku i tregut?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Rreziku që lidhet me përfitimin e mundshëm nga një investim',
                    'B' => 'Rreziku që vjen nga pasiguria e ekonomisë dhe tregjeve financiare',
                    'C' => 'Rreziku që lidhet me kostot e larta të investimeve',
                    'D' => 'Rreziku i humbjes së të gjithë kapitalit të investuar',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është përfitimi kryesor i diversifikimit në investime?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Rritja e kthimeve të mundshme',
                    'B' => 'Zvogëlimi i rrezikut të humbjes',
                    'C' => 'Shtimi i fitimeve të shpejta',
                    'D' => 'Përqendrimi i kapitalit në një investim të vetëm',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është menaxhimi i rrezikut?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Eliminimi i mundësive të humbjes',
                    'B' => 'Identifikimi dhe zvogëlimi i mundësive për humbje financiare',
                    'C' => 'Përfitimi nga mundësitë e rritjes së shpejtë',
                    'D' => 'Rritja e vëllimit të investimeve pa analiza të thella',
                ]),
                'correct_answer' => 'B',
            ],
            // (Shtoni pyetje të tjera për Investimet dhe Menaxhimi i Rrezikut)
        ];
        
        foreach ($questions11 as $questionData) {
            $quiz11->questions()->create($questionData);
        }
        
        $quiz12 = Quiz::create([
            'category' => 'Ekonomi',
            'title' => 'Sistemi Bankar dhe Rregulloret',
            'description' => 'Ky kuiz mbulon sistemin bankar dhe rregulloret që rregullojnë funksionimin e tij në nivel kombëtar dhe ndërkombëtar.',
        ]);
        
        $questions12 = [
            [
                'question' => 'Çfarë është një sistem bankar?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një koleksion i bankave dhe institucioneve të tjera financiare',
                    'B' => 'Një institucion që ofron vetëm kredi për individët',
                    'C' => 'Një sistem që merret me prodhimin dhe shpërndarjen e parave',
                    'D' => 'Një shërbim që ofron vetëm investime private',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cila është roli kryesor i Bankës Qendrore?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të ofrojë kredi për individët',
                    'B' => 'Të menaxhojë politikën monetare dhe stabilitetin financiar',
                    'C' => 'Të mbajë një sistem bankar për qytetarët',
                    'D' => 'Të rregullojë çmimet e mallrave në tregje',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është një rregullore bankare?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një udhëzim për mënyrën se si bankat mund të kryejnë transaksione',
                    'B' => 'Një ligj që ndalon bankat të ofrojnë kredi',
                    'C' => 'Një udhëzim që ka të bëjë me menaxhimin e fitimeve të bankave',
                    'D' => 'Një dokument që përshkruan procedurat për kontrollin e investimeve të bankave',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është një kërkesë kapitali nga bankat?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një ligj që kërkon nga bankat të mbajnë një shumë të caktuar kapital për të mbështetur aktivitetet e tyre',
                    'B' => 'Një procedurë për të rritur fitimet e bankave',
                    'C' => 'Një rregull që ndalon bankat të marrin kredi',
                    'D' => 'Një kërkesë për të ndihmuar klientët të zhvillojnë investime',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është një shembull i një rregulloreje ndërkombëtare për sistemin bankar?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Basel III',
                    'B' => 'Gold Standard',
                    'C' => 'New York Stock Exchange',
                    'D' => 'Dodd-Frank Act',
                ]),
                'correct_answer' => 'A',
            ],
            // (Shtoni pyetje të tjera për Sistemi Bankar dhe Rregulloret)
        ];
        
        foreach ($questions12 as $questionData) {
            $quiz12->questions()->create($questionData);
        }

        $quiz13 = Quiz::create([
            'category' => 'Banka dhe Financa',
            'title' => 'Banka',
            'description' => 'Ky kuiz mbulon konceptet bazë të bankave, llojet e bankave, dhe funksionet që ato kryejnë.',
        ]);
        
        $question13 = [
            [
                'question' => 'Çfarë është një bankë komerciale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një bankë që ofron kredi për individët dhe biznese',
                    'B' => 'Një bankë që ofron shërbime për qeveritë',
                    'C' => 'Një bankë që ruan depozita të përkohshme për klientët e saj',
                    'D' => 'Një bankë që menaxhon burimet financiare ndërkombëtare',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cila është një nga funksionet kryesore të bankës?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Ofrimi i shërbimeve të ndihmës për individët pa interes',
                    'B' => 'Menaxhimi i likuiditetit dhe kredive për individët dhe bizneset',
                    'C' => 'Prodhimi i monedhës dhe kuponëve',
                    'D' => 'Sigurimi i burimeve financiare për qeverinë',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cili është një shembull i bankave të pasigurta?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Banka Kombëtare e Shqipërisë',
                    'B' => 'Banka Qendrore e Shqipërisë',
                    'C' => 'Banka e Investimeve',
                    'D' => 'Banka e Shërbimeve Postare',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Çfarë është një depozitë bankare?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një lloj kredie që individët marrin nga banka',
                    'B' => 'Një lloj fondi që bankat ofrojnë për bizneset',
                    'C' => 'Një shumë e parave që individët dhe kompanitë ruajnë në një bankë',
                    'D' => 'Një lloj investimi në aksione dhe obligacione',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Cili është rreziku kryesor për bankat?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Rreziku nga ndryshimi i normave të interesit',
                    'B' => 'Rreziku nga konsumatorët që tërheqin depozitat e tyre',
                    'C' => 'Rreziku nga kreditorët që nuk paguajnë borxhet',
                    'D' => 'Të gjitha përgjigjet janë të sakta',
                ]),
                'correct_answer' => 'D',
            ],
            // (Shtoni pyetje të tjera për Banka)
        ];
        
        foreach ($question13 as $questionData) {
            $quiz13->questions()->create($questionData);
        }
        
        $quiz14 = Quiz::create([
            'category' => 'Banka dhe Financa',
            'title' => 'Financa',
            'description' => 'Ky kuiz mbulon konceptet bazë të financave personale dhe menaxhimin financiar.',
        ]);
        
        $question14 = [
            [
                'question' => 'Çfarë është financa personale?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Menaxhimi i pasurisë dhe të ardhurave për individët',
                    'B' => 'Investimi i parave të tjera për të fituar pasuri',
                    'C' => 'Të drejtat dhe përgjegjësitë ligjore të individëve në financa',
                    'D' => 'Përdorimi i kapitalit për të ndihmuar biznese të mëdha',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është një shembull i një aset të paluajtshëm?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një llogari bankare',
                    'B' => 'Një automjet',
                    'C' => 'Një pasuri e patundshme si një shtëpi',
                    'D' => 'Një llogari pensioni',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Çfarë është një buxhet?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një plan që tregon të ardhurat dhe shpenzimet për një periudhë të caktuar',
                    'B' => 'Një investim afatgjatë në tregjet financiare',
                    'C' => 'Një plan për shpenzime të pasiguruara',
                    'D' => 'Një marrëveshje e ligjshme për kredinë e individëve',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Çfarë është një kredi?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një lloj depozite që individët bëjnë në bankë',
                    'B' => 'Një shërbim që ofron interes për pasuri',
                    'C' => 'Një shumë e parave që individët dhe bizneset marrin nga një bankë ose institucion tjetër për të financuar shpenzimet',
                    'D' => 'Një investim në aksione të një kompanie',
                ]),
                'correct_answer' => 'C',
            ],
            [
                'question' => 'Çfarë është një normë interesi?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Shuma e parave që një bankë paguan për depozitat e klientëve',
                    'B' => 'Përqindja që përdoret për të llogaritur kthimin nga investimet',
                    'C' => 'Përqindja që një kredi mund të arrijë për një periudhë të caktuar',
                    'D' => 'Të gjitha përgjigjet janë të sakta',
                ]),
                'correct_answer' => 'D',
            ],
            // (Shtoni pyetje të tjera për Financa)
        ];
        
        foreach ($question14 as $questionData) {
            $quiz14->questions()->create($questionData);
        }
        
        $quiz15 = Quiz::create([
            'category' => 'Shkenca Kompjuterike',
            'title' => 'Shkenca Kompjuterike',
            'description' => 'Ky kuiz mbulon njohuri bazë dhe përparësore të shkencave kompjuterike, duke përfshirë algoritmet, struktura të të dhënave dhe programimin.',
        ]);
        
        $questions15 = [
            [
                'question' => 'Çfarë është një algoritëm?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një kod që kryen një detyrë specifike pas një sërë hapash të përshkruar',
                    'B' => 'Një tip i veçantë i programimit të orientuar nga objektet',
                    'C' => 'Një gjuhë programimi e përdorur për të ndihmuar programuesit',
                    'D' => 'Një funksion matematikor për kërkimin e të dhënave',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cila është struktura më e përdorur për të ruajtur të dhënat në memoria kompjuterike?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Arrat',
                    'B' => 'Listat lidhëse',
                    'C' => 'Stivët dhe radhët',
                    'D' => 'Struktura të dhënash më komplekse',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është një shembull i një algoritmi për kërkim në një listë të pa renditur?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Kërkimi binar',
                    'B' => 'Kërkimi linear',
                    'C' => 'Kërkimi me dy ndarje',
                    'D' => 'Algoritmi i ndarjes dhe mbikëqyrjes',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Çfarë është një struktura e të dhënave "hash table"?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një tabelë e përdorur për të ruajtur të dhënat dhe për të arritur atyre shpejtë',
                    'B' => 'Një strukturë që përdor algoritme matematikore për të organizuar të dhënat',
                    'C' => 'Një lloj algoritmi për të rregulluar të dhënat',
                    'D' => 'Një tabelë që ruan të dhëna në formë numerike të organizuar',
                ]),
                'correct_answer' => 'A',
            ],
            [
                'question' => 'Cili është koncepti i "recursion" në programim?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Një mënyrë e përdorur për të shmangur përdorimin e funksioneve',
                    'B' => 'Një funksion që thërret veten për të zgjidhur një problem të ndarë në pjesë më të vogla',
                    'C' => 'Një funksion që kryen një detyrë vetëm një herë',
                    'D' => 'Një lloj algoritmi që përdor rrethana të jashtme për të funksionuar',
                ]),
                'correct_answer' => 'B',
            ],
            [
                'question' => 'Cila është rëndësia e kompleksitetit kohor dhe hapësinor në analizën e algoritmeve?',
                'type' => 'multiple-choice',
                'options' => json_encode([
                    'A' => 'Të mundësojë ndarjen e problemeve dhe t’i zgjidhë ato më shpejtë',
                    'B' => 'Të masë sa shpejt dhe sa burime konsumon një algoritëm për të zgjidhur një problem',
                    'C' => 'Të përmirësojë përdorimin e memorjes dhe ngarkesën e sistemeve',
                    'D' => 'Të ndihmojë në optimizimin e programeve për përdorues të ndryshëm',
                ]),
                'correct_answer' => 'B',
            ],
            // (Shtoni pyetje të tjera për Shkenca Kompjuterike)
        ];
        
        foreach ($questions15 as $questionData) {
            $quiz15->questions()->create($questionData);
        }
        
        
    }
}

        
