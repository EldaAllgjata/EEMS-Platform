Dokumenti i Specifikimit të Kërkesave

Tiranë, më 24.04.2025

Emri i projektit:”Sistemi i menaxhimit të klasave (Platforma EEMS)”

Autorët:Elda Allgjata
               Fjona Karaj
               Iris Memo
               

1.	Hyrje
Ky dokument përshkruan kërkesat funksionale dhe jo funksionale për zhvillimin e sistemit “Platforma EEMS – Sistemi i Menaxhimit të Klasave”. Ai synon të japë një pamje të qartë të funksionaliteteve që sistemi duhet të ofrojë dhe mënyrës se si ai do të përdoret nga përdoruesit e ndryshëm.
Dokumenti shërben si bazë për:
•	zhvillimin e aplikacionit nga ekipi, 
•	komunikimin ndërmjet anëtarëve të ekipit dhe palëve të interesuara, 
•	testimin dhe validimin e sistemit në fund të zhvillimit.
1.1	Qëllimi i dokumentit
Ky dokument ka për qëllim të përshkruajë në mënyrë të plotë dhe të strukturuar kërkesat për ndërtimin e sistemit “Platforma EEMS – Sistemi i Menaxhimit të Klasave”.
Ai përfshin:
•	kërkesat funksionale (çfarë bën sistemi), 
•	kërkesat jo funksionale (si duhet të funksionojë sistemi), 
•	kufizimet dhe supozimet. 
Dokumenti:
•	Do të përdoret nga ekipi i zhvillimit për implementim. 
•	Do të ndihmojë në organizimin e punës sipas metodologjisë Agile. 
•	Do të shërbejë si bazë për testim dhe verifikim të sistemit.
2.	Përshkrim i përgjithshëm
2.1	Problemi
Në shkollat e mesme private, menaxhimi i informacionit për nxënësit, klasat, notat dhe mungesat shpesh realizohet në mënyrë manuale ose përmes mjeteve të shpërndara si Excel, komunikime në rrjete sociale ose dokumente fizike.
Kjo sjell probleme si:
3.	mungesë koordinimi ndërmjet mësuesve dhe prindërve, 
4.	vështirësi në monitorimin e progresit të nxënësve, 
5.	komunikim i ngadaltë dhe jo i strukturuar, 
6.	rrezik për humbje ose keqmenaxhim të të dhënave.
2.2	 Zgjidhja aktuale
Aktualisht, menaxhimi i informacionit në shkolla bëhet përmes:
•	Excel ose regjistrave fizikë për notat dhe mungesat, 
•	komunikimeve në WhatsApp ose email për njoftime, 
•	takimeve fizike për informim të prindërve, 
•	dokumenteve të shpërndara pa një sistem të centralizuar. 
Kjo mënyrë sjell:
•	gabime në të dhëna, 
•	mungesë transparence, 
•	humbje kohe për administrimin manual, 
•	vështirësi në aksesin në kohë reale të informacionit.
2.3	Palët e interesuara
Administrata e shkollës: kërkon menaxhim të centralizuar dhe raportim të saktë. 
Mësuesit: duan të regjistrojnë notat dhe mungesat lehtësisht. 
Prindërit: duan të informohen në kohë reale për performancën e fëmijëve. 

2.4	Përdoruesit dhe karakteristikat e tyre
Administratori
•	Roli: Menaxhon përdoruesit, klasat dhe sistemin. 
•	Karakteristika: Njohuri të mira kompjuterike 
•	Nevoja: Kontroll i plotë mbi sistemin
Mësuesit
•	Roli: Vendosin nota ;Regjistrojnë mungesa 
•	Karakteristika: Njohuri bazë në teknologji 
•	Nevoja: Ndërfaqe e thjeshtë dhe e shpejtë
Prindërit
•	Roli: Monitorojnë performancën e fëmijëve 
•	Karakteristika: Njohuri bazë teknologjike 
•	Nevoja: Informim në kohë reale
2.5	Mjedisi operacional
Platforma EEMS do të jetë një aplikacion web.
Front-End:
•	HTML, CSS, JavaScript 
•	Responsive për mobile dhe desktop 
Back-End:
•	PHP 
•	MySQL databazë 
Mjedisi:
•	XAMPP për zhvillim lokal 
•	Visual Studio Code për programim 
Pajisjet:
•	Laptop, desktop, smartphone 
Browser:
•	Chrome, Firefox, Edge

2.6	Kufizime
•	Nuk përfshin pagesa online 
•	Platforma fillimisht vetëm në shqip 
•	Nuk ka integrime komplekse me sisteme të jashtme 

2.7	Supozime dhe varësi
Supozime:
•	Përdoruesit kanë internet 
•	Përdoruesit kanë pajisje të përshtatshme 
•	Përdoruesit kanë njohuri bazë teknologjike 
Varësi:
•	XAMPP server 
•	MySQL databaza 
•	Browser modern
3	Kërkesa
3.2	Kërkesa funksionale
3.2.1.1	Kërkesa FR-01: Regjistrimi i përdoruesit 
3.2.1.2	Përcaktmi
Sistemi duhet të lejojë përdoruesit (mësues, nxënës, prindër) të regjistrohen duke përdorur email dhe fjalëkalim.
3.2.1.3	Prioriteti
I lartë – funksionalitet bazë i sistemit.
3.2.1.4	Inpute
•	Emër 
•	Mbiemër 
•	Email 
•	Fjalëkalim 
•	Konfirmim fjalëkalimi 
•	 Roli (nxënës / mësues / prind)
3.2.1.5	Përpunime
•	Validimi i të dhënave 
•	Kontroll nëse email ekziston 
•	Enkriptimi i fjalëkalimit 
•	Ruajtja në databazë
3.2.1.6	Outpute
•	Krijimi i llogarisë 
•	Mesazh: “Regjistrimi u krye me sukses”
3.2.1.7	Situata te veçanta
Situata	Veprimi i sistemit
Email i pavlefshëm	Mesazh gabimi
Email ekziston	Paralajmërim
Fjalëkalimi nuk përputhet	Mesazh gabimi

3.2.1.8	Lidhje me kërkesa të tjera
Kërkesa e lidhur		Përshkrimi
FR-02	Login
3.2.3	Kërkesa për siguri – enkriptimi i të dhënave

3.2.2.1	Kërkesa FR-02: Hyrja në sistem (Login) 
3.2.2.2	Përcaktmi
Përdoruesi hyn në sistem me email dhe fjalëkalim.
3.2.2.3	Prioriteti
I lartë.
3.2.2.4	Inpute
•	Email 
•	Fjalëkalim
3.2.2.5	Përpunime
•	Verifikim i kredencialeve 
•	Krahasim me databazën
3.2.2.5 Outpute
•	Hyrje në sistem 
•	Redirect në dashboard
3.2.2.6	Situata te veçanta
Situata	Veprimi
Email ose password gabim	Mesazh gabimi

3.3	Kërkesa jo funksionale
3.3.2	Performanca
•	Faqja të ngarkohet < 2 sekonda 
•	Përpunimi i kërkesave < 1 sekondë 
•	Të mbështesë min. 50 përdorues njëkohësisht
3.3.3	Disponueshmëria (Availability)
•	99% uptime 
•	Mirëmbajtje natën
3.3.4	Siguria
•	Fjalëkalime të enkriptuara 
•	HTTPS 
•	Autentikim i sigurt
3.3.5	Portabiliteti
•	Chrome, Firefox, Edge 
•	Windows, Android, iOS 
•	Responsive design 
3.3.6	Besueshmëria (Reliability)
•	Sistemi pa crash për 48-72 orë 
•	Logim gabimesh 
•	Recovery pa humbje të dhënash

3.4	Kërkesa për ndërfaqe
3.4.2	Kërkesa për ndërfaqen grafike
•	UI e thjeshtë 
•	Responsive 
•	Navigim i qartë 
3.4.3	Kërkesa për ndërfaqe me sisteme të jashtme
3.4.4	Kërkesa për ndërfaqe me harduer

3.5	Kufizime

1.Kufizime teknike
•	Vetëm web app 
•	Vetëm shqip
2. Kufizime operacionale
•	12 javë zhvillim 
•	Ekip studentor
3. Kufizime ligjore dhe të privatësisë
Nuk ruhen të dhëna sensitive 
4	Skenarë të përdorimit
4.2	Profilet e përdoruesve
4.2 	Rastet e përdorimit
Emërtimi 	Vendosja e notës
Aktori kryesor	Mesues 
Përshkrim i përgjithshëm	Mësuesi vendos nota për nxënësit në një klasë të caktuar për një lëndë të caktuar.
Parakushte	Mësuesi është i loguar në sistem 
Klasa dhe nxënësit ekzistojnë në databazë 
Lënda është e regjistruar në sistem
Skenari	Mësuesi zgjedh klasën 
Sistemi shfaq listën e nxënësve 
Mësuesi zgjedh nxënësin 
Mësuesi vendos notën 
Mësuesi klikon “Ruaj” 
Sistemi ruan notën në databazë 
Shfaqet mesazh konfirmimi
Përjashtime	Nota jashtë intervalit të lejuar → shfaqet gabim 
Nxënësi nuk ekziston → operacioni ndalohet 
Gabim në databazë → shfaqet mesazh gabimi
Prioriteti	I lartë – funksion kryesor i sistemit
Kur duhet të jetë në dispozicion	Gjithmonë gjatë përdorimit të sistemit nga mësuesit 
Veçanërisht gjatë periudhës së vlerësimit
Shpeshtësia e përdorimit	E larte
Ndërfaqja me aktorin kryesor	Paneli i mësuesit (dashboard) 
Formë për vendosjen e notave 
Lista e nxënësve
Ndërfaqja me aktorët dytësorë	Prindërit (monitorojnë notat)
Çeshtje të hapura	A do të lejohet modifikimi i notës pas ruajtjes? 
A do të ruhet historiku i ndryshimeve të notave? 
A do të dërgohen njoftime automatike për nota të reja?


4.3	Rastet e veçanta të përdorimit
•	Vendosja e notës për nxënës që mungon 
•	Modifikimi i një note ekzistuese 
•	Vendosja e notës për klasë pa nxënës 
•	Dështim në ruajtjen e të dhënave 
•	Vendosja e notës jashtë intervalit të lejuar 
•	Skadimi i sesionit (logout automatik)
5	Modeli i analizes

5.2	Modeli i funksional
Funksioni	Përshkrimi
Regjistrimi i përdoruesit	Përdoruesi krijon llogari me email dhe fjalëkalim.
Hyrja në system	Përdoruesi identifikohet në sistem.
Menaxhimi i klasave	Administratori krijon dhe menaxhon klasat.
Menaxhimi i përdoruesve	Shtim, modifikim dhe fshirje e nxënësve, mësuesve dhe prindërve.
Vendosja e notave	Mësuesi vendos nota për nxënësit.
Regjistrimi i mungesave	Mësuesi regjistron mungesat e nxënësve.
Shikimi i rezultateve	Nxënësit dhe prindërit shohin notat dhe mungesat.
Dërgimi i njoftimeve	Sistemi dërgon njoftime për ndryshime, nota dhe mungesa.
Gjenerimi i raporteve	Sistemi gjeneron raporte për performancën e nxënësve.
5.3	Modeli i objekteve
Objekte (entitete):
• Klasa
•	ID_Klasa 
•	Emri_Klasës 
•	Viti 
• Nxënës
•	ID_Nxënësi 
•	Emër 
•	Mbiemër 
•	ID_Klasa 
• Mungesa
•	ID_Mungesa 
•	ID_Nxënësi 
•	Data 
•	Statusi 
• Njoftim
•	ID_Njoftimi 
•	Përmbajtja 
•	Data
🔸 Marrëdhënie:
•	Një klasë ka shumë nxënës 
•	Një nxënës ka shumë nota 
•	Një nxënës ka shumë mungesa 
•	Një mësues vendos shumë nota 
•	Një prind lidhet me një ose më shumë nxënës

