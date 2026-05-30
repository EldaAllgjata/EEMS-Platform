Dokumenti i Specifikimit të Konceptimit të Software (Design)

Tiranë, më 05.05.2025

Emri i projektit:EEMS-Platform

Autorët: Elda Allgjata
                Iris Memo 
                Fjona Karaj

 
Dokumentimi i Modelimit të Sistemit
1.	Hyrje
1.1 Objektiva të modelimit

Ky dokument ka si objektiv të përshkruaj strukturën arkitekturore dhe projektimin e sistemit EEMS-Platform (Elite Education Management System). Dokumenti detajon organizimin e komponentëve kryesorë të sistemit, mënyrën e komunikimit ndërmjet tyre, menaxhimin e të dhënave, sigurinë, kontrollin e aksesit dhe strategjitë për backup dhe monitorim.
Qëllimi kryesor i këtij dokumenti është të sigurojë një bazë të qartë për zhvillimin, testimin dhe mirëmbajtjen e sistemit, duke garantuar zgjerueshmëri, siguri dhe funksionim të qëndrueshëm të platformës.

1.2	Përcaktime, akronime, shkurtime
            
            UI – User Interface 
DB – Database 
CRUD – Create, Read, Update, Delete 
RBAC – Role-Based Access Control 
HTTP/HTTPS – HyperText Transfer Protocol / Secure 
MySQL – Sistemi për menaxhimin e bazës së të dhënave 
QR Code – Quick Response Code

1.3 Referenca

Dokumenti i specifikimeve të kërkesave për EEMS-Platform 
Materialet e kursit “Hyrje në Inxhinieri Softuerike” 
Dokumentacioni zyrtar i PHP dhe MySQL 

1.	Arkitektura e propozuar e sistemit
3.1	Pershkrim i pergjithshem
Stili arkitekturor i zgjedhur për EEMS-Platform është Three-Tier Architecture, i ndarë në tre shtresa kryesore:
1.	Prezantimi (Frontend/UI)
Ndërfaqja grafike e përdoruesit është zhvilluar me HTML, CSS, JavaScript. Kjo shtresë mundëson ndërveprimin e përdoruesve me sistemin, duke ofruar forma për login, regjistrim, menaxhim të të dhënave dhe shfaqje të informacionit. 
2.	Logjika e biznesit (Backend)
Backend-i është zhvilluar me PHP dhe përmban logjikën kryesore të sistemit, si: 
o	autentikimi i përdoruesve; 
o	menaxhimi i roleve (admin, teacher, parent); 
o	përpunimi i notave, pagesave dhe aktiviteteve; 
o	validimi i të dhënave; 
o	komunikimi me databazën. 
3.	Shtresa e të dhënave (Database Layer)
Sistemi përdor MySQL për ruajtjen dhe menaxhimin e të dhënave të qëndrueshme, duke përfshirë: 
o	nxënësit; 
o	mësuesit; 
o	prindërit; 
o	klasat; 
o	notat; 
o	pagesat; 
o	aktivitetet. 
Ky stil arkitekturor është zgjedhur sepse:
•	siguron ndarje të qartë të përgjegjësive ndërmjet komponentëve të sistemit; 
•	lehtëson mirëmbajtjen dhe zgjerimin e platformës; 
•	mundëson zhvillim dhe testim të ndarë të frontend-it dhe backend-it; 
•	rrit sigurinë dhe organizimin e kodit; 
•	përmirëson performancën dhe menaxhimin e të dhënave. 

EEMS-Platform është një sistem i ri dhe aktualisht nuk ekziston një implementim i mëparshëm funksional. Sistemi po zhvillohet nga ekipi i projektit si një platformë për menaxhimin e aktiviteteve shkollore, nxënësve, mësuesve, prindërve, klasave dhe pagesave.

3.2 Dekompozimi ne nensisteme
Sistemi ndahet në nënsistemet e mëposhtme:
1.	Admin Module
Përgjegjës për:
•	menaxhimin e nxënësve; 
•	menaxhimin e mësuesve; 
•	menaxhimin e prindërve; 
•	menaxhimin e klasave; 
•	menaxhimin e pagesave; 
•	menaxhimin e aktiviteteve; 
•	menaxhimin e profileve dhe mailbox-it. 

Teacher Module
Përgjegjës për:
•	vendosjen e notave; 
•	raportimin mbi pjesëmarrjen; 
•	menaxhimin e nxënësve të klasës. 

Parent Module
Përgjegjës për:
•	shikimin e notave të fëmijës; 
•	kontrollin e pjesëmarrjes; 
•	marrjen e njoftimeve dhe aktiviteteve. 

Authentication Module
Përgjegjës për:
•	login/logout; 
•	kontrollin e sesioneve; 
•	verifikimin e roleve. 

•	Database Layer
Përgjegjës për:
•	ruajtjen e të dhënave; 
•	ekzekutimin e query-ve; 
•	menaxhimin e marrëdhënieve ndërmjet tabelave. 
Komunikimi ndërmjet moduleve realizohet përmes kërkesave HTTP dhe query-ve SQL.

3.3 Percaktimi i lidhjeve hardware/ software
EEMS-Platform është projektuar si një aplikacion web që ekzekutohet në një mjedis lokal ose cloud.
Frontend
•	Zhvillohet me HTML, CSS, JavaScript. 
•	Ekzekutohet në browser-in e përdoruesit. 
Backend
•	Zhvillohet me PHP. 
•	Ekzekutohet në Apache Server përmes XAMPP ose hosting online. 
Database
•	MySQL përdoret për ruajtjen e të dhënave. 
•	Komunikimi realizohet përmes mysqli. 
Server Environment
•	Apache Web Server 
•	PHP Runtime 
•	MySQL Database Server 
Pajisjet e përdoruesve
•	Sistemi mund të aksesohet nga:
•	kompjuterë desktop; 
•	laptop; 
•	pajisje mobile.

3.4 Menaxhimi i te dhenave te qendrueshme
EEMS-Platform përdor MySQL për menaxhimin e të dhënave të qëndrueshme.
Tabelat kryesore përfshijnë:
•	admin – ruan të dhënat e administratorëve; 
•	mesues – ruan të dhënat e mësuesve; 
•	prinder – ruan të dhënat e prindërve; 
•	nxenes – ruan informacionet e nxënësve; 
•	klasa – ruan klasat e shkollës; 
•	nota – ruan notat e nxënësve; 
•	pagesat – ruan informacionet e pagesave; 
•	aktivitete – ruan aktivitetet shkollore; 
•	pjesemarrja – ruan prezencën e nxënësve. 
Menaxhimi i të dhënave
•	Të dhënat ruhen në mënyrë të strukturuar përmes marrëdhënieve foreign key. 
•	Sistemi përdor query SQL për operacionet CRUD. 
•	Integriteti i të dhënave garantohet përmes constraints dhe validimeve. 
Siguria e të dhënave
•	Qasja në databazë lejohet vetëm për përdorues të autorizuar. 
•	Password-et ruhen të enkriptuara. 
•	Përdoren sesione për autentikim të sigurt. 
Diagrami i databazës
•	Diagrami ER përfshin marrëdhënie si:
•	Klasa ↔ Nxënës 
•	Nxënës ↔ Nota 
•	Nxënës ↔ Pagesa 
•	Mësues ↔ Klasa 
•	Prind ↔ Nxënës
 
3.5 Kontrolli i aksesit dhe siguria
Siguria është një element shumë i rëndësishëm në EEMS-Platform.
Autentikimi
Përdoruesit identifikohen përmes:
•	username/email; 
•	password. 
•	Pas login-it krijohet një session për përdoruesin.
Autorizimi
Sistemi përdor role:
•	Admin 
•	Teacher 
•	Parent 
•	Çdo rol ka akses vetëm në funksionalitetet përkatëse.
Admin
•	akses i plotë në sistem. 
Teacher
•	akses vetëm në notat dhe pjesëmarrjen. 
Parent
•	akses vetëm në informacionin e fëmijës. 
Siguria e të dhënave
•	Password-et ruhen të hash-uara. 
•	Validim input-i për të shmangur SQL Injection. 
•	Përdorimi i session management. 
•	Kontroll i aksesit për çdo faqe. 
Siguria e komunikimit
•	Sistemi mund të përdorë HTTPS për komunikim të sigurt. 
•	Session timeout për mbrojtje nga akseset e paautorizuara. 
3.6 Rrjedha e kontrollit

Login i përdoruesit
•	Përdoruesi plotëson formularin e login-it. 
•	Të dhënat dërgohen në backend përmes PHP. 
•	Sistemi kontrollon kredencialet në databazë. 
•	Nëse kredencialet janë të sakta: 
1.	krijohet session; 
2.	përdoruesi ridrejtohet sipas rolit. 
•	Nëse kredencialet janë të pasakta: 
1.	shfaqet mesazh gabimi. 
Shembull: Vendosja e notave nga mësuesi
•	Mësuesi hyn në sistem. 
•	Zgjedh klasën dhe nxënësin. 
•	Plotëson notën. 
•	Backend validon të dhënat. 
•	Nota ruhet në databazë. 
•	Prindi dhe nxënësi mund ta shikojnë notën në sistem. 
Elemente mbështetëse
•	Menaxhimi i gabimeve
Sistemi përdor:
•	mesazhe gabimi; 
•	kontroll të query-ve SQL. 
Auditimi
•	Veprimet kryesore regjistrohen për kontroll dhe monitorim.
Feedback në UI
•	Përdoruesit marrin:
•	alerts; 
•	mesazhe konfirmimi; 
•	mesazhe gabimi.
3.7	Shërbimet që ofrojnë nënsistemet
Nënsistemi	Shërbimet
UI Layer	Login/logout, menaxhim profile, shfaqje të dhënash
Admin Module	Menaxhim nxënësish, mësuesish, prindërish, klasash, pagesash dhe aktiviteteve
Teacher Module	Vendosje notash, raportim pjesëmarrjeje
Parent Module	Shikim notash, pjesëmarrjeje dhe njoftimeve
Authentication Module	Login, logout, session management
Database Layer	Ruajtje dhe menaxhim i të dhënave
Kjo strukturë modulare mundëson:
•	mirëmbajtje më të lehtë; 
•	zgjerim të sistemit; 
•	siguri më të lartë; 
•	organizim më të mirë të kodit.


1.	Strategjia backup dhe e rikuperimit të sistemit
Për të garantuar mbrojtjen e të dhënave dhe vazhdimësinë e sistemit, EEMS-Platform implementon strategji backup dhe rikuperimi.
Backup
•	Backup automatik i databazës MySQL. 
•	Ruajtje periodike e kopjeve rezervë. 
•	Kopje shtesë në pajisje ose cloud storage. 
Rikuperimi
Në rast:
•	dështimi të serverit; 
•	gabimeve njerëzore; 
•	korruptimit të databazës; 
•	sistemi mund të rikthehet përmes backup-eve.
Siguria e backup-eve
•	Akses vetëm për administratorët. 
•	Backup-et ruhen të mbrojtura. 
•	Testime periodike të rikuperimit. 
Kjo strategji ndihmon në:
•	minimizimin e humbjes së të dhënave; 
•	rikthimin e shpejtë të sistemit; 
•	rritjen e besueshmërisë së platformës. 

2.	Monitorimi i performancës
Monitorimi i performancës ndihmon në identifikimin e problemeve dhe optimizimin e sistemit.
EEMS-Platform monitoron:
•	kohën e përgjigjes së faqeve; 
•	ngarkesën e serverit; 
•	query-t SQL; 
•	gabimet në backend; 
•	performancën e databazës. 
Mjetet e monitorimit
•	Apache Logs 
•	PHP Error Logs 
•	MySQL Monitoring 
•	Browser Developer Tools 
Funksionalitetet e monitorimit
•	identifikimi i gabimeve; 
•	kontrolli i performancës; 
•	optimizimi i query-ve; 
•	monitorimi i përdorimit të burimeve. 

