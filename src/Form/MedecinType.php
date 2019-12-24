<?php

namespace App\Form;

use App\Entity\Medecin;

use App\Entity\Service;
use App\Entity\Specialite;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedecinType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
           
            ->add('prenom')
            ->add('nom')
            ->add('datenais',DateType::class,[
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
            ])
            ->add('tel')
            ->add('service',EntityType::class,[
                'class' => Service::class,
                'by_reference' => false,
                'choice_label' => 'libelle'])
            ->add('specialite',null,['expanded'=>true])
            ->add('save',SubmitType::class,['label'=>'enregistrer'] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Medecin::class,
        ]);
    }
}
