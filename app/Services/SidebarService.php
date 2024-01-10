<?php
namespace App\Services;

use Modules\Ynotz\EasyAdmin\Contracts\SidebarServiceInterface;

class SidebarService implements SidebarServiceInterface
{
    public function getSidebarData(): array
    {
        return [
            [

                'type' => 'menu_group',
                'title' => 'Access Control',
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showRoles(),
                'menu_items' => [
                    [
                        'type' => 'menu_item',
                        'title' => 'Users',
                        'route' => 'users.index',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showRoles()
                    ],
                    [
                        'type' => 'menu_item',
                        'title' => 'Roles',
                        'route' => 'roles.index',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showRoles()
                    ],
                    [
                        'type' => 'menu_item',
                        'title' => 'Permissions',
                        'route' => 'permissions.index',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showPermissions()
                    ],
                    [
                        'type' => 'menu_item',
                        'title' => 'Role-wise Permissions',
                        'route' => 'roles.permissions',
                        'route_params' => [],
                        'icon' => 'easyadmin::icons.users',
                        'show' => $this->showPermissions()
                    ],
                ],
                
            ],
            [
                'type' => 'menu_item',
                'title' => 'Categories',
                'route' => 'categories.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showCategories()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Product Types',
                'route' => 'producttypes.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showProductTypes()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Products',
                'route' => 'products.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showProducts()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Product Quantities',
                'route' => 'quantities.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showRoles()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Tags',
                'route' => 'tags.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showTags()
            ],
         
            [
                'type' => 'menu_item',
                'title' => 'Address',
                'route' => 'addresses.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showAddress()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Address tags',
                'route' => 'addresstags.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showAddressTags()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Product Sizes',
                'route' => 'sizes.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showProductSizes()
            ],
           
            [
                'type' => 'menu_item',
                'title' => 'Product variants',
                'route' => 'productvariants.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showProductVariants()
            ],
            [
                'type' => 'menu_item',
                'title' => 'Attributes',
                'route' => 'attributes.index',
                'route_params' => [],
                'icon' => 'easyadmin::icons.users',
                'show' => $this->showAttributes()
            ],
            
            // [
            //     'type' => 'menu_item',
            //     'title' => 'Attribute Values',
            //     'route' => 'attributevalues.index',
            //     'route_params' => [],
            //     'icon' => 'easyadmin::icons.users',
            //     'show' => $this->showProductSizes()
            // ],



            // [
            //     'type' => 'menu_section',
            //     'title' => 'Menu Group',
            //     'icon' => 'easyadmin::icons.gear',
            //     'show' => $this->showRoles(),
            //     'menu_items' => [
            //         [
            //             'type' => 'menu_item',
            //             'title' => 'Menu Item Two',
            //             'route' => 'home',
            //             'route_params' => [],
            //             'icon' => 'easyadmin::icons.plus',
            //             'show' => $this->showRoles()
            //         ],
            //     ]
            // ],
            // [
            //     'type' => 'menu_item',
            //     'title' => 'Menu Item Two',
            //     'route' => 'home',
            //     'route_params' => [],
            //     'icon' => 'easyadmin::icons.plus',
            //     'show' => $this->showRoles()
            // ],
        ];
    }

    private function showArticles()
    {
        return auth()->check();
    }
    private function showRoles()
    {
        return auth()->check();
    }
    private function showPermissions()
    {
        return auth()->check();
    }
    private function showProducts()
    {
        return auth()->user()->hasPermissionTo('Products-Add');
    }
    private function showProductTypes()
    {
        return auth()->user()->hasPermissionTo('Product-Type-Add');
    }
    private function showCategories()
    {
        return auth()->user()->hasPermissionTo('Categories-Add');
    }
    private function showQuantity()
    {
        return auth()->user()->hasPermissionTo('Quantity-Add');
    }
    private function showTags()
    {
        return auth()->user()->hasPermissionTo('Tags-Add');
    }
    private function showProductTags()
    {
        return auth()->user()->hasPermissionTo('Categories-Add');
    }
    private function showAddress()
    {
        return auth()->user()->hasPermissionTo('Address-Add');
    }
    private function showAddressTags()
    {
        return auth()->user()->hasPermissionTo('Address-Tag-Add');
    }
    private function showProductSizes()
    {
        return auth()->user()->hasPermissionTo('Size-Add');
    }
    private function showProductVariants()
    {
        return auth()->user()->hasPermissionTo('Product-Variant-Add');
    }
    private function showAttributes()
    {
        return auth()->user()->hasPermissionTo('Attribute-Add');
    }

  

    
}
?>
