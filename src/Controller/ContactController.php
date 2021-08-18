<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class ContactController extends AbstractController
{
    /**
     * @Route("/", name="homepage", methods={"GET"})
     * @param ContactRepository $contactRepository
     * @return Response
     */
    public function index(EntityManagerInterface $em): Response
    {
        // Affichage des fiches contact
        $repository = $em->getRepository(Contact::class);
        $contacts = $repository->findAll();

        return $this->render('contact/index.html.twig', [
            'contacts' => $contacts,
        ]);  
    }

    /**
     * @Route("/send", name="contact")
     */
    public function send(Request $request, \Swift_Mailer $mailer): Response
    {
        // Création du formulaire
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        // Envoi des infos en bdd
        if ($form->isSubmitted() && $form->isValid()) {

            // Récupère l'entity manager qui va nous permettre d'interagir avec la BDD
            $em = $this->getDoctrine()->getManager();
            // Persiste l'objet $contact à l'entity manager 
            $em->persist($contact);
            // Exécute la requête en bdd
            $em->flush();

            // Préparation de l'envoi du mail 
            $contact_mail = $form->getData()->getMail();
            $department_mail = $form->get('department')->getData()->getMail();
            // On crée le message
            $message = (new \Swift_Message('Nouvelle fiche contact'))
            // On attribue l'expéditeur
            ->setFrom($contact_mail)
            // On attribue le destinataire
            ->setTo($department_mail)
            // On crée le texte avec la vue
            ->setBody(
                $this->renderView(
                    'email/contact.html.twig', compact('contact')
                ),
                'text/html'
            );

            // Envoi du mail
            $mailer->send($message);

            $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi

            return $this->redirectToRoute(
                'homepage',
            );
        }

    	return $this->render('contact/send.html.twig', [
            'form' => $form->createView(),
            $department = $form->get('department')->getData() // Récupération de la liste des départements
        ]);
    }
}
