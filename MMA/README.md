# CloudProjectMMA
Specifiche progetto finale
Realizzare un sito web per la gestione di un catalogo personale di foto. Le foto devono essere archiviate in un database locale (localhost) che verrà utilizzato anche per memorizzare i tag associati alla foto, generati tramite un servizio cloud di machine learning. Questi tag verranno utilizzati per facilitare la ricerca di una foto.
Le foto sono visibili solo per gli utenti registrati al sito, tramite con email e password.
Ogni utente può vedere solo le foto di sua proprietà e potrà eventualmente decidere di condividere alcune delle sue foto su internet, tramite un'apposita URL contenente un token temporaneo di autorizzazione. Il token avrà una scadenza (una data) definibile al momento della condivisione. 
 
Specifiche
Il sito deve prevedere le seguenti pagine:
una pagina di registrazione nuovo utente;
una pagina di login;
una pagina per la gestione delle foto che consenta di aggiungere una foto (upload) e di eliminare una o più foto;
una pagina per la ricerca di una foto basata sui tag memorizzati (ed eventualmente sui dati Exif, vedi note due Punti extra);
una pagina per la visualizzazione di tutte le foto, ordinate in base alla data di inserimento (la pagina di visualizzazione e di ricerca può anche essere gestita in una sola pagina);
una pagina per la visualizzazione di una foto con tutti i tag e le informazioni associate;
una funzione per la condivisione delle foto su internet tramite l'utilizzo di un token con scadenza. La data di scadenza del token deve essere selezionabile al momento della condivisione.
 
E' possibile utilizzare qualsiasi linguaggio di programmazione di backend per la creazione del progetto.
Le immagini devono essere memorizzate in un servizio cloud (S3 di AWS o Blob storage di Azure).
Il database per la memorizzazione delle foto può essere di qualsiasi tipo (es. MySQL, SQL Server, SQLite, MongoDB, etc) e dovrà girare localmente (su localhost).
Per il servizio di machine learning per l'estrazione dei tag associati a una foto è possibile utilizzare  Computer Vision di Azure o Amazon Rekognition di AWS. 
I progetti devono essere memorizzati in un repository github pubblico (di uno degli appartenenti al gruppo). La consegna deve essere fatta tramite piattaforma Moodle, inviando un file .ZIP del progetto. Nel file .ZIP deve essere presente un file README che spiega come configurare il progetto.
Punti extra
I seguenti punti sono facoltativi e se realizzati correttamente daranno dei punti extra al voto finale.
Durante l'upload di una foto è possibile estrarre informazioni associate alla foto (ad esempio la data dello scatto della foto, le specifiche della macchina fotogratica, etc. Vedi formato Exif). Queste informazioni possono essere memorizzate nel database per migliorare le ricerche.
Utilizzando le informazioni Exif associate ad una foto, creare una pagina con Google Maps per visualizzare la posizione delle foto di un utente. Ad ogni foto deve essere associato un Marker con il link verso la pagina della foto.
Note
Per estrarre informazioni Exif di una foto è possibile utilizzare la funzione exif_read_data() del PHP.
