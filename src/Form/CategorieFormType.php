<?php

namespace App\Form;

use App\Entity\Catgorie;
use App\Repository\CatgorieRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategorieFormType extends AbstractType
{
    private $countElement;

    public function __construct(CatgorieRepository $catgorieRepository)
    {
        $this->countElement = count($catgorieRepository->findAll())+1;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,['label_attr' => array('class' => 'col-sm-12')])
            ->add('Color',TextType::class,['label_attr' => array('class' => 'col-sm-12')])
            ->add('Icon',HiddenType::class)
            ->add('pos',HiddenType::class,['data' => $this->countElement])
            ->add('submit',SubmitType::class,['attr' => ['class' => 'btn btn-dark mt-2'],'label' => 'Enregistrer la catégorie'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Catgorie::class,
        ]);
    }
}
