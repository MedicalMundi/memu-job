<?php declare(strict_types=1);

namespace Backoffice\Adapter\HttpWeb;

use Ramsey\Uuid\Uuid;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VueController extends AbstractController
{
    /**
     * @Route("/vue", name="backoffice_vue", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(): Response
    {
        return $this->render('@backoffice/vue/index.html.twig', [

        ]);
    }

    /**
     * @Route("/vue-data", name="backoffice_vue_fake_data", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function fakeData(): Response
    {
        return $this->json([
            'concorsi' => $this->getStaticData(),
        ]);
    }

    private function getStaticData(): array
    {
        return [
            [
                'id' => Uuid::uuid4()->toString(),
                'titolo' => 'Concorso pubblico, per titoli ed esami, per la copertura di un posto di dirigente medico, disciplina di medicina del lavoro e sicurezza degli ambienti di lavoro.',
                'body' => " Con decreto del direttore generale dell'A.T.S. di Brescia n.  290
                                del 18 maggio 2022 e' indetto concorso pubblico, per titoli ed esami,
                                per un posto di dirigente medico - disciplina medicina del  lavoro  e
                                sicurezza degli ambienti di lavoro (Decreto D.G. n. 290 del 18 maggio
                                2022). 
                                    Possono essere ammessi al concorso pubblico coloro che  siano  in
                                possesso dei  requisiti  generali  e  dei  requisiti  specifici  come
                                dettagliatamente descritto nel testo integrale del bando di concorso. 
                                    La domanda di  ammissione  al  concorso  pubblico  dovra'  essere
                                inoltrata esclusivamente secondo la specifica modalita' indicata  nel
                                bando di concorso, entro e non oltre il trentesimo giorno  successivo
                                alla pubblicazione del presente  estratto  nella  Gazzetta  Ufficiale
                                della Repubblica italiana - 4ª Serie speciale «Concorsi ed esami». 
                                    Il testo integrale del bando di concorso  pubblico e'  pubblicato
                                nel Bollettino Ufficiale della Regione  Lombardia -  Serie  Avvisi  e
                                Concorsi - n. 22 del 1° giugno 2022 e sara' reso disponibile, a  mero
                                titolo di pubblicita'  -  notizia,  sul  sito  internet  dell'Agenzia
                                (www.ats-brescia.it) nella sezione «Amministrazione Trasparente». 
                                    Per ulteriori informazioni gli interessati possono rivolgersi  al
                                Servizio gestione personale e sviluppo professionale dell'Agenzia  di
                                tutela della salute di Brescia - viale Duca degli  Abruzzi  n.  15  -
                                Brescia - Telefono 030.383.8291-253 (orario di apertura  al  pubblico
                                dal lunedi' al venerdi' dalle  ore  9,00  alle  ore  12,00  -  sabato
                                escluso). ",
                'permalink' => 'https://www.example.com',
                'expire' => 'CONCORSO (scad. 14 luglio 2022)',
                'ente' => 'AGENZIA DI TUTELA DELLA SALUTE DI BRESCIA',
            ],

            [
                'id' => Uuid::uuid4()->toString(),
                'titolo' => 'Concorso pubblico, per titoli ed esami, per la copertura di un posto di dirigente medico, disciplina di medicina del lavoro e sicurezza degli ambienti di lavoro.',
                'body' => " Con decreto del direttore generale dell'A.T.S. di Brescia n.  290
                                del 18 maggio 2022 e' indetto concorso pubblico, per titoli ed esami,
                                per un posto di dirigente medico - disciplina medicina del  lavoro  e
                                sicurezza degli ambienti di lavoro (Decreto D.G. n. 290 del 18 maggio
                                2022). 
                                    Possono essere ammessi al concorso pubblico coloro che  siano  in
                                possesso dei  requisiti  generali  e  dei  requisiti  specifici  come
                                dettagliatamente descritto nel testo integrale del bando di concorso. 
                                    La domanda di  ammissione  al  concorso  pubblico  dovra'  essere
                                inoltrata esclusivamente secondo la specifica modalita' indicata  nel
                                bando di concorso, entro e non oltre il trentesimo giorno  successivo
                                alla pubblicazione del presente  estratto  nella  Gazzetta  Ufficiale
                                della Repubblica italiana - 4ª Serie speciale «Concorsi ed esami». 
                                    Il testo integrale del bando di concorso  pubblico e'  pubblicato
                                nel Bollettino Ufficiale della Regione  Lombardia -  Serie  Avvisi  e
                                Concorsi - n. 22 del 1° giugno 2022 e sara' reso disponibile, a  mero
                                titolo di pubblicita'  -  notizia,  sul  sito  internet  dell'Agenzia
                                (www.ats-brescia.it) nella sezione «Amministrazione Trasparente». 
                                    Per ulteriori informazioni gli interessati possono rivolgersi  al
                                Servizio gestione personale e sviluppo professionale dell'Agenzia  di
                                tutela della salute di Brescia - viale Duca degli  Abruzzi  n.  15  -
                                Brescia - Telefono 030.383.8291-253 (orario di apertura  al  pubblico
                                dal lunedi' al venerdi' dalle  ore  9,00  alle  ore  12,00  -  sabato
                                escluso). ",
                'permalink' => 'https://www.example.com',
                'expire' => 'CONCORSO (scad. 14 luglio 2022)',
                'ente' => 'AGENZIA DI TUTELA DELLA SALUTE DI BRESCIA',
            ],

            [
                'id' => Uuid::uuid4()->toString(),
                'titolo' => 'Concorso pubblico, per titoli ed esami, per la copertura di un posto di dirigente medico, disciplina di medicina del lavoro e sicurezza degli ambienti di lavoro.',
                'body' => " Con decreto del direttore generale dell'A.T.S. di Brescia n.  290
                                del 18 maggio 2022 e' indetto concorso pubblico, per titoli ed esami,
                                per un posto di dirigente medico - disciplina medicina del  lavoro  e
                                sicurezza degli ambienti di lavoro (Decreto D.G. n. 290 del 18 maggio
                                2022). 
                                    Possono essere ammessi al concorso pubblico coloro che  siano  in
                                possesso dei  requisiti  generali  e  dei  requisiti  specifici  come
                                dettagliatamente descritto nel testo integrale del bando di concorso. 
                                    La domanda di  ammissione  al  concorso  pubblico  dovra'  essere
                                inoltrata esclusivamente secondo la specifica modalita' indicata  nel
                                bando di concorso, entro e non oltre il trentesimo giorno  successivo
                                alla pubblicazione del presente  estratto  nella  Gazzetta  Ufficiale
                                della Repubblica italiana - 4ª Serie speciale «Concorsi ed esami». 
                                    Il testo integrale del bando di concorso  pubblico e'  pubblicato
                                nel Bollettino Ufficiale della Regione  Lombardia -  Serie  Avvisi  e
                                Concorsi - n. 22 del 1° giugno 2022 e sara' reso disponibile, a  mero
                                titolo di pubblicita'  -  notizia,  sul  sito  internet  dell'Agenzia
                                (www.ats-brescia.it) nella sezione «Amministrazione Trasparente». 
                                    Per ulteriori informazioni gli interessati possono rivolgersi  al
                                Servizio gestione personale e sviluppo professionale dell'Agenzia  di
                                tutela della salute di Brescia - viale Duca degli  Abruzzi  n.  15  -
                                Brescia - Telefono 030.383.8291-253 (orario di apertura  al  pubblico
                                dal lunedi' al venerdi' dalle  ore  9,00  alle  ore  12,00  -  sabato
                                escluso). ",
                'permalink' => 'https://www.example.com',
                'expire' => 'CONCORSO (scad. 14 luglio 2022)',
                'ente' => 'AGENZIA DI TUTELA DELLA SALUTE DI BRESCIA',
            ],

            [
                'id' => Uuid::uuid4()->toString(),
                'titolo' => 'Concorso pubblico, per titoli ed esami, per la copertura di un posto di dirigente medico, disciplina di medicina del lavoro e sicurezza degli ambienti di lavoro.',
                'body' => " Con decreto del direttore generale dell'A.T.S. di Brescia n.  290
                                del 18 maggio 2022 e' indetto concorso pubblico, per titoli ed esami,
                                per un posto di dirigente medico - disciplina medicina del  lavoro  e
                                sicurezza degli ambienti di lavoro (Decreto D.G. n. 290 del 18 maggio
                                2022). 
                                    Possono essere ammessi al concorso pubblico coloro che  siano  in
                                possesso dei  requisiti  generali  e  dei  requisiti  specifici  come
                                dettagliatamente descritto nel testo integrale del bando di concorso. 
                                    La domanda di  ammissione  al  concorso  pubblico  dovra'  essere
                                inoltrata esclusivamente secondo la specifica modalita' indicata  nel
                                bando di concorso, entro e non oltre il trentesimo giorno  successivo
                                alla pubblicazione del presente  estratto  nella  Gazzetta  Ufficiale
                                della Repubblica italiana - 4ª Serie speciale «Concorsi ed esami». 
                                    Il testo integrale del bando di concorso  pubblico e'  pubblicato
                                nel Bollettino Ufficiale della Regione  Lombardia -  Serie  Avvisi  e
                                Concorsi - n. 22 del 1° giugno 2022 e sara' reso disponibile, a  mero
                                titolo di pubblicita'  -  notizia,  sul  sito  internet  dell'Agenzia
                                (www.ats-brescia.it) nella sezione «Amministrazione Trasparente». 
                                    Per ulteriori informazioni gli interessati possono rivolgersi  al
                                Servizio gestione personale e sviluppo professionale dell'Agenzia  di
                                tutela della salute di Brescia - viale Duca degli  Abruzzi  n.  15  -
                                Brescia - Telefono 030.383.8291-253 (orario di apertura  al  pubblico
                                dal lunedi' al venerdi' dalle  ore  9,00  alle  ore  12,00  -  sabato
                                escluso). ",
                'permalink' => 'https://www.example.com',
                'expire' => 'CONCORSO (scad. 14 luglio 2022)',
                'ente' => 'AGENZIA DI TUTELA DELLA SALUTE DI BRESCIA',
            ],

        ];
    }
}
