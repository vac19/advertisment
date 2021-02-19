# salecto/advertisment

In admin: Manages advertisments with banner Image, Title, Description, Active From & To, Display on Pages and status Options.

In front: Addes a menu item at top navigation and displays the Image and Title underneath the menu navigation section depending upon backend options.

Module Can be active/deactivete from configuration. 

## Composer install

- `composer config repositories.reponame vcs https://github.com/vac19/advertisment`
- `composer require salecto2/magento2-advertisment`

## Composer uninstall

- `composer remove salecto2/magento2-advertisment`

## Preview

![config-option](/readme-images/config-option.png "Configuration Option")
![admin-option](/readme-images/admin-option.png "Admin Option")
![admin-grid](/readme-images/admin-grid.png "Admin Grid")
![admin-form](/readme-images/admin-form.png "Admin Form")
![edit-form](/readme-images/edit-form.png "Edit Form")
![front-end](/readme-images/front-end.png "Display at Front End")

## Settings
Desrcribe each settings from the backend, and what effect they have.

- Option `STORES/Configuration/Salecto - Advertisment` - Enables or disable the module
- Option `Content/Elements-Advertisment` - Admin grid to add or edit advertisment.

## Known issues

- **After add/edit advertisment no advertisment/changes appear on frontend**\
  It is require to clear catch each time when advertisment added or edited ~ Locally.

## Developer informations

### Install module
1. Run `composer require salecto2/magento2-advertisment`
2. Run `php bin/magento setup:upgrade`
3. Run `php bin/magento setup:di:compile`
4. Run `php bin/magento s:s:d da_DK en_US`
5. Run `php bin/magento c:c`

### Uninstall module
1. Run `composer require salecto2/magento2-advertisment`
2. Run `php bin/magento setup:di:compile`
3. Run `php bin/magento s:s:d da_DK en_US`
4. Run `php bin/magento c:c`

### Additional developer notes
