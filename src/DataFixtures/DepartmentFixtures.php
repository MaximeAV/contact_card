<?php

namespace App\DataFixtures;

use App\Entity\Department;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DepartmentFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // Génération des données pour les départements
        $name = "Direction";
        $responsible = "Louis-Arnaud Catoire";
        $mail = "la.catoire@itefficience.com";
        $department = new Department();
        $department->setName($name);
        $department->setResponsible($responsible);
        $department->setMail($mail);
        $manager->persist($department);
        $manager->flush();

        $name = "RH";
        $responsible = "Bill Gates";
        $mail = "bill.gates@itefficience.com";
        $department = new Department();
        $department->setName($name);
        $department->setResponsible($responsible);
        $department->setMail($mail);
        $manager->persist($department);
        $manager->flush();

        $name = "Communication";
        $responsible = "Elon Musk";
        $mail = "elon.musk@itefficience.com";
        $department = new Department();
        $department->setName($name);
        $department->setResponsible($responsible);
        $department->setMail($mail);
        $manager->persist($department);
        $manager->flush();

        $name = "Développement";
        $responsible = "Maxime Avaulée";
        $mail = "maxime.avaulee@gmail.com";
        $department = new Department();
        $department->setName($name);
        $department->setResponsible($responsible);
        $department->setMail($mail);
        $manager->persist($department);
        $manager->flush();

        $name = "Logistique";
        $responsible = "Jeff Bezos";
        $mail = "jeff.bezos@itefficience.com";
        $department = new Department();
        $department->setName($name);
        $department->setResponsible($responsible);
        $department->setMail($mail);
        $manager->persist($department);
        $manager->flush();
    }
}