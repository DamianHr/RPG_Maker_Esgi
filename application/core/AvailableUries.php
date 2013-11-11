<?php

class AvailableUries
{
    const default_controller = 'default_controller'; //(default_controller = home/view
    const home = 'home'; //(home = home/view
    const index = 'index'; //(index = home/view
    const empty_chain = ''; //((:any) = home/view/$1

    const home_user = 'home_user'; //(home_user = home_user/view
//const home_user = 'home_user'; //(home_user/(:any) = home_user/view/$1

    const signout = 'signout'; //(signout = sign_out/view
//const signout = 'signout'; //(signout/(:any) = sign_out/view/$1

    const subscription = 'subscription'; //(subscription = subscription/view
//const subscription = 'subscription'; //(subscription/(:any) = subscription/view/$1

    const rpg = 'rpg'; //(rpg = rpg_list/view
//const rpg = 'rpg'; //(rpg/(:any) = rpg_list/view/$1
    const list_ = 'list'; //(list = rpg_list/view
//const list = 'list'; //(list/(:any) = rpg_list/view/$1
    const rpg_list = 'rpg_list'; //(rpg_list = rpg_list/view
//const rpg_list = 'rpg_list'; //(rpg_list/(:any) = rpg_list/view/$1

    const new_ = 'new'; //(new = rpg_creation/view
//const new = 'new'; //(new/(:any) = rpg_creation/view/$1
    const create = 'create'; //(create = rpg_creation/view
//const create = 'create'; //(create/(:any) = rpg_creation/view/$1
    const creation = 'creation'; //(creation = rpg_creation/view
//const creation = 'creation'; //(creation/(:any) = rpg_creation/view/$1
    const rpg_creation = 'rpg_creation'; //(rpg_creation = rpg_creation/view
//const rpg_creation = 'rpg_creation'; //(rpg_creation/(:any) = rpg_creation/view/$1
//const rpg_creation = 'rpg_creation'; //(rpg_creation = rpg_creation/view
//const rpg_creation = 'rpg_creation'; //(rpg_creation/(:any) = rpg_creation/view/$1

}