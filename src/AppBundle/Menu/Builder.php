<?php
/**
 * Created by PhpStorm.
 * User: spajx
 * Date: 29.5.16
 * Time: 15:56
 */

namespace AppBundle\Menu;


use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;

/**
 * Class Builder
 * @package AppBundle\Menu
 */
class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    /**
     * @param FactoryInterface $factory
     * @return \Knp\Menu\ItemInterface
     */
    public function mainMenu(FactoryInterface $factory)
    {
        $menu = $factory->createItem('root');
        $menu->setChildrenAttributes(['class' => 'sidebar-menu']);

        $menu->addChild('Dashboard', ['route' => 'dashboard'])->setAttribute('icon', 'fa fa-dashboard');

        $menu->addChild('Profile', ['route' => 'fos_user_profile_show'])->setAttribute('icon', 'fa fa-user');

        $menu->addChild('Time Entries', ['route' => 'timeentry_index'])->setAttribute('icon', 'fa fa-clock-o');
        $menu->addChild('Time Card', ['route' => 'timecard_index'])->setAttribute('icon', 'fa fa-list-alt');

        return $menu;
    }
}