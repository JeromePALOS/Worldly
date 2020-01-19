php bin/console make:entity

php bin/console make:migration
php bin/console doctrine:migrations:migrate



php bin/console make:crud
ou
php bin/console make:controller ArticleController
php bin/console make:form

add route

state-create:
  path: /state/create
  controller: App\Controller\StateController::createState

state-view:
  path: /state/view/{id}
  controller: App\Controller\StateController::viewState

state-list:
  path: /state/liste
  controller: App\Controller\StateController::listState

state-delete:
  path: /state/delete/{id}
  controller: App\Controller\StateController::deleteState

state-update:
  path: /state/update/{id}
  controller: App\Controller\StateController::updateState
  
  
  
  php bin/console server:run
  
  
  
  php bin/console doctrine:schema:update --force

  
  
  
  
  
  
  
  fos user
  php bin/console fos:user:promote testuser ROLE_ADMIN
  php bin/console fos:user:demote testuser ROLE_ADMIN# Worldly
