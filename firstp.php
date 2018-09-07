<html lang="en" ng-app="StarterApp">
  <head>
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/angular_material/0.10.0/angular-material.min.css">
    <link rel="noopener" href="styles.scss"/>
  </head>
  <body layout="row" ng-controller="AppCtrl">
    <!-- <md-sidenav layout="column" class="md-sidenav-left md-whiteframe-z2 md-navigation-drawer" md-component-id="left" md-is-locked-open="$mdMedia('gt-md')">
      <md-toolbar class="md-hue-2 md-tall">
        <span flex></span>
        <div layout="row" layout-align="start center">
          <md-icon class="md-avatar" md-svg-icon="avatars:svg-1"></md-icon>
          <span flex></span>
        </div>
        <span flex></span>
        <div class="md-body-2">Firstname Lastname</div>
        <div class="md-body-1">email@domainname.com</div>
      </md-toolbar>
      <md-list>
        <md-list-item class="md-2-line" ng-repeat="item in menu" role="link" ng-click="toggleSidenav('left')">
          <md-icon md-svg-icon="{{item.icon}}" aria-label="{{item.title}}"></md-icon>
          <div class="md-list-item-text">
            <span class="md-body-2">{{item.title}}</span>
          </div>
        </md-list-item>
        <md-divider></md-divider>
        <md-subheader  class="md-no-sticky">Management</md-subheader>
        <md-list-item class="md-2-line" ng-repeat="item in admin" role="link" ng-click="toggleSidenav('left')">
          <md-icon md-svg-icon="{{item.icon}}" aria-label="{{item.title}}"></md-icon>
          <div class="md-list-item-text">
            <span class="md-body-2">{{item.title}}</span>
          </div>
        </md-list-item>
      </md-list>
    </md-sidenav> -->
    <md-content layout="column" class="relative" layout-fill role="main">
      <md-button class="md-fab md-fab-bottom-right" aria-label="Add" ng-click="showAdd($event)">
        <md-icon md-svg-icon="content:ic_add_24px" aria-label="Plus"></md-icon>
      </md-button>

      <md-content flex layout="row">
        <md-sidenav layout="column" layout-fill class="md-sidenav-left md-sidenav-list" md-component-id="nav" md-is-locked-open="$mdMedia('gt-sm')">
            <md-toolbar class="md-whiteframe-z1" ng-class="{'md-hue-1':showSearch}">
              <div class="md-toolbar-tools">
                <md-button class="md-icon-button" ng-click="toggleSidenav('left')" hide-gt-md aria-label="Menu">
                  <md-icon md-svg-icon="navigation:ic_menu_24px" aria-label="Menu"></md-icon>
                </md-button>
                <h3 ng-if="!showSearch">
                  Apps
                </h3>
                <span flex ng-if="!showSearch"></span>
                <md-button class="md-icon-button" aria-label="Search" ng-click="toggleSearch()">
                  <md-icon ng-if="!showSearch" md-svg-icon="action:ic_search_24px" aria-label="Search"></md-icon>
                  <md-icon ng-if="showSearch" md-svg-icon="navigation:ic_arrow_back_24px" aria-label="Back"></md-icon>
                </md-button>
                <md-input-container md-theme="input" ng-show="showSearch">
                  <label>&nbsp;</label>
                  <input ng-model="search.title" placeholder="enter search">
                </md-input-container>
              </div>
            </md-toolbar>
            <md-list flex>
              <md-list-item class="md-2-line" ng-repeat="item in apps | filter:search" role="link" ng-click="toggleSidenav('nav'); $parent.appIcon = item.icon; $parent.appName = item.title; $parent.appDesc = item.desc;">
                <md-icon md-svg-icon="{{item.icon}}" aria-label="{{item.title}}"></md-icon>
                <div class="md-list-item-text">
                  <div class="md-body-2">{{item.title}}</div>
                  <p class="md-body-2">{{item.desc}}</p>
                </div>
                <md-divider></md-divider>
              </md-list-item>

            </md-list>
          </md-sidenav>
        <md-content layout="column" layout-fill>
          <md-toolbar class="animate-show md-whiteframe-z1">
            <div class="md-toolbar-tools">
              <md-button class="md-icon-button" ng-click="toggleSidenav('nav')" hide-gt-sm aria-label="Menu">
                <md-icon md-svg-icon="navigation:ic_arrow_back_24px" aria-label="Menu"></md-icon>
              </md-button>
              <span flex></span>
              <md-button class="md-icon-button" aria-label="Open Settings" ng-click="showListBottomSheet($event)">
                <md-icon md-svg-icon="navigation:ic_more_vert_24px" aria-label="More"></md-icon>
              </md-button>
            </div>
          </md-toolbar>
          <div class="inset" hide-sm></div>
            <div layout-gt-sm="row" layout-align="center center">
              <div flex-gt-sm="95" flex-gt-lg="80">
                <md-card>
                  <md-toolbar class="animate-show md-hue-2" ng-show="!editApp">
                    <md-list-item class="md-3-line">
                      <md-icon class="md-avatar" hide-sm md-svg-icon="{{appIcon || 'navigation:ic_apps_24px'}}"></md-icon>
                      <div class="md-list-item-text">
                        <div class="md-headline">{{appName || 'App Name'}}</div>
                        <h4>{{appDesc || 'App description goes here'}}</h4>
                      </div>
                    </md-list-item>
                  </md-toolbar>
                  <md-toolbar class="animate-show md-hue-1 edit-app" ng-show="editApp">
                    <md-list-item class="md-3-line">
                      <md-icon class="md-avatar" hide-sm md-svg-icon="{{appIcon || 'navigation:ic_apps_24px'}}"></md-icon>
                      <div class="md-list-item-text">
                        <md-input-container>
                          <label>App Name</label>
                          <input ng-model="appName">
                        </md-input-container>
                        <md-input-container>
                          <label>App Description</label>
                          <input ng-model="appDesc">
                        </md-input-container>
                      </div>
                    </md-list-item>
                    <md-divider></md-divider>
                  </md-toolbar>
                  <md-list>
                    <md-list-item class="md-3-line" ng-repeat="item in attributes">
                      <md-icon class="md-accent" hide-sm md-svg-icon="{{item.icon}}"></md-icon>
                      <div class="md-list-item-text">
                        <h3>{{item.value || 'Attribute value'}}</h3>
                        <p>{{item.title || 'Attribute title'}}</p>
                      </div>
                      <md-divider md-inset hide-sm></md-divider>
                      <md-divider hide-gt-sm></md-divider>
                    </md-list-item>
                    <md-list-item class="md-3-line">
                      <md-icon class="md-accent" hide-sm md-svg-icon="editor:ic_linear_scale_24px"></md-icon>
                      <div class="md-list-item-text" ng-init="appScale = 20">
                        <h3>{{appScale}} units</h3>
                        <md-slider ng-show="editApp" flex md-discrete step="1" min="1" max="50" ng-model="appScale" aria-label="Scale"></md-slider>
                        <p>Scale</p>
                      </div>
                    </md-list-item>
                    <md-divider></md-divider>
                    <md-list-item>
                      <md-button class="md-primary" ng-show="!editApp">
                        <md-icon md-svg-icon="navigation:ic_arrow_forward_24px" aria-label="Forward"></md-icon>
                        <span>Execute</span>
                      </md-button>
                      <md-button class="md-primary" ng-click="editApp = 0" ng-show="editApp">
                        <md-icon md-svg-icon="navigation:ic_check_24px" aria-label="Save"></md-icon>
                        <span>Save</span>
                      </md-button>
                      <md-button ng-click="editApp = 1" ng-show="!editApp">
                        <md-icon md-svg-icon="editor:ic_mode_edit_24px" aria-label="Edit"></md-icon>
                        <span>Edit</span>
                      </md-button>
                      <span flex></span>
                      <md-button class="md-warn" ng-show="!editApp">
                        <md-icon md-svg-icon="action:ic_delete_24px" aria-label="Delete"></md-icon>
                        <span>Delete</span>
                      </md-button>
                      <md-button ng-click="editApp = 0" ng-show="editApp">
                        <md-icon md-svg-icon="navigation:ic_close_24px" aria-label="Cancel"></md-icon>
                        <span>Cancel</span>
                      </md-button>
                    </md-list-item>
                  </md-list>
                </md-card>
              </div>
          </div>
        </md-content>
      </md-content>
    </md-content>
    <!-- Angular Material Dependencies -->
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-animate.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular-aria.js"></script>
    <!-- Angular Material -->
    <script src="//ajax.googleapis.com/ajax/libs/angular_material/0.10.0/angular-material.min.js"></script>
    <script>
    var app = angular.module('StarterApp', ['ngMaterial']);

    app.controller('AppCtrl', ['$scope', '$mdBottomSheet','$mdSidenav', '$mdDialog', function($scope, $mdBottomSheet, $mdSidenav, $mdDialog){
  
  // Toolbar search toggle
  $scope.toggleSearch = function(element) {
    $scope.showSearch = !$scope.showSearch;
  };
  
  // Sidenav toggle
  $scope.toggleSidenav = function(menuId) {
    $mdSidenav(menuId).toggle();
  };
  
  // Menu items
  $scope.menu = [
    {
      link : '',
      title: 'Dashboard',
      icon: 'action:ic_dashboard_24px'
    },
    {
      link : '',
      title: 'Friends',
      icon: 'social:ic_group_24px'
    },
    {
      link : '',
      title: 'Messages',
      icon: 'communication:ic_message_24px'
    }
  ];
  $scope.admin = [
    {
      link : '',
      title: 'Trash',
      icon: 'action:ic_delete_24px'
    },
    {
      link : 'showListBottomSheet($event)',
      title: 'Settings',
      icon: 'action:ic_settings_24px'
    }
  ];
  
  // App items
  $scope.apps = [
    {
      link : '',
      title: 'Workload',
      desc: 'App description goes here',
      icon: 'action:ic_donut_large_24px'
    },
    {
      link : '',
      title: 'Memberships',
      desc: 'App description goes here',
      icon: 'action:ic_card_membership_24px'
    },
    {
      link : '',
      title: 'Transactions',
      desc: 'App description goes here',
      icon: 'action:ic_shopping_cart_24px'
    },
    {
      link : '',
      title: 'Categories',
      desc: 'App description goes here',
      icon: 'device:ic_storage_24px'
    },
    {
      link : '',
      title: 'Geographics',
      desc: 'App description goes here',
      icon: 'maps:ic_place_24px'
    },
    {
      link : 'showListBottomSheet($event)',
      title: 'Business',
      desc: 'welcome to B2B',
      icon: 'action:ic_store_24px'
    },
    {
      link : '',
      title: 'Financials',
      desc: 'App description goes here',
      icon: 'editor:ic_attach_money_24px'
    },
    {
      link : '',
      title: 'VP Dashboard',
      desc: 'App description goes here',
      icon: 'action:ic_dashboard_24px'
    },
    {
      link : '',
      title: 'Inventory',
      desc: 'App description goes here',
      icon: 'editor:ic_format_list_numbered_24px'
    },
    {
      link : '',
      title: 'Employees',
      desc: 'App description goes here',
      icon: 'action:ic_perm_identity_24px'
    }
  ];
  
  // Mock attributes
  $scope.attributes = [
      {
        title: 'Owner',
        value: 'Scott Alexander',
        icon: 'action:ic_assignment_ind_24px'
      },
      {
        title: 'Last updated',
        value: 'Dec 12, 2015',
        icon: 'action:ic_today_24px'
      },
      {
        title: 'DNS',
        value: 'https://appname-environment.company.com:8080',
        icon: 'action:ic_dns_24px'
      },
      {
        title: 'Version',
        value: '02.08.10.02',
        icon: 'action:ic_fingerprint_24px'
      },
    ];
  
  // Bottomsheet & Modal Dialogs
  $scope.alert = '';
  $scope.showListBottomSheet = function($event) {
    $scope.alert = '';
    $mdBottomSheet.show({
      template: '<md-bottom-sheet class="md-list md-has-header"><md-list><md-list-item class="md-2-line" ng-repeat="item in items" role="link" md-ink-ripple><md-icon md-svg-icon="{{item.icon}}" aria-label="{{item.name}}"></md-icon><div class="md-list-item-text"><h3>{{item.name}}</h3></div></md-list-item> </md-list></md-bottom-sheet>',
      controller: 'ListBottomSheetCtrl',
      targetEvent: $event
    }).then(function(clickedItem) {
      $scope.alert = clickedItem.name + ' clicked!';
    });
  };
  
  $scope.showAdd = function(ev) {
    $mdDialog.show({
      controller: DialogController,
      template: '<md-dialog aria-label="Form"> <md-content class="md-padding"> <form name="userForm"> <div layout layout-sm="column"> <md-input-container flex> <label>First Name</label> <input ng-model="user.firstName"> </md-input-container> <md-input-container flex> <label>Last Name</label> <input ng-model="user.lastName"> </md-input-container> </div> <md-input-container flex> <label>Message</label> <textarea ng-model="user.biography" columns="1" md-maxlength="150"></textarea> </md-input-container> </form> </md-content> <div class="md-actions" layout="row"> <span flex></span> <md-button ng-click="answer(\'not useful\')"> Cancel </md-button> <md-button ng-click="answer(\'useful\')" class="md-primary"> Save </md-button> </div></md-dialog>',
      targetEvent: ev,
    })
    .then(function(answer) {
      $scope.alert = 'You said the information was "' + answer + '".';
    }, function() {
      $scope.alert = 'You cancelled the dialog.';
    });
  };
}]);

app.controller('ListBottomSheetCtrl', function($scope, $mdBottomSheet) {
  $scope.items = [
    { name: 'Share', icon: 'social:ic_share_24px' },
    { name: 'Upload', icon: 'file:ic_cloud_upload_24px' },
    { name: 'Copy', icon: 'content:ic_content_copy_24px' },
    { name: 'Print this page', icon: 'action:ic_print_24px' },
  ];
  
  $scope.listItemClick = function($index) {
    var clickedItem = $scope.items[$index];
    $mdBottomSheet.hide(clickedItem);
  };
});

function DialogController($scope, $mdDialog) {
  $scope.hide = function() {
    $mdDialog.hide();
  };
  $scope.cancel = function() {
    $mdDialog.cancel();
  };
  $scope.answer = function(answer) {
    $mdDialog.hide(answer);
  };
};

app.controller('DemoCtrl', DemoCtrl);
  function DemoCtrl ($timeout, $q) {
    var self = this;
    // list of `state` value/display objects
    self.states        = loadAll();
    self.selectedItem  = null;
    self.searchText    = null;
    self.querySearch   = querySearch;
    // ******************************
    // Internal methods
    // ******************************
    /**
     * Search for states... use $timeout to simulate
     * remote dataservice call.
     */
    function querySearch (query) {
      var results = query ? self.states.filter( createFilterFor(query) ) : [];
      return results;
    }
    /**
     * Build `states` list of key/value pairs
     */
    function loadAll() {
      var allStates = 'Ali Conners, Alex, Scott, Jennifer, \
              Sandra Adams, Brian Holt, \
              Trevor Hansen';
      return allStates.split(/, +/g).map( function (state) {
        return {
          value: state.toLowerCase(),
          display: state
        };
      });
    }
    /**
     * Create filter function for a query string
     */
    function createFilterFor(query) {
      var lowercaseQuery = angular.lowercase(query);
      return function filterFn(state) {
        return (state.value.indexOf(lowercaseQuery) === 0);
      };
    }
  };

app.config(function($mdThemingProvider) {
  var customBlueMap =     $mdThemingProvider.extendPalette('indigo', {
    'contrastDefaultColor': 'light',
    'contrastDarkColors': ['50'],
    '50': 'ffffff'
  });
  $mdThemingProvider.definePalette('customBlue', customBlueMap);
  $mdThemingProvider.theme('default')
    .primaryPalette('customBlue', {
      'default': '500',
      'hue-1': '50'
    })
    .accentPalette('pink');
  $mdThemingProvider.theme('input', 'default')
    .primaryPalette('grey')
});

app.config(function($mdIconProvider) {
    $mdIconProvider
      // linking to https://github.com/google/material-design-icons/tree/master/sprites/svg-sprite
      // 
      .iconSet('action', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-action.svg', 24)
      .iconSet('alert', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-alert.svg', 24)
      .iconSet('av', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-av.svg', 24)
      .iconSet('communication', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-communication.svg', 24)
      .iconSet('content', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-content.svg', 24)
      .iconSet('device', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-device.svg', 24)
      .iconSet('editor', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-editor.svg', 24)
      .iconSet('file', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-file.svg', 24)
      .iconSet('hardware', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-hardware.svg', 24)
      .iconSet('image', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-image.svg', 24)
      .iconSet('maps', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-maps.svg', 24)
      .iconSet('navigation', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-navigation.svg', 24)
      .iconSet('notification', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-notification.svg', 24)
      .iconSet('social', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-social.svg', 24)
      .iconSet('toggle', 'https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-toggle.svg', 24)
    
      // Illustrated user icons used in the docs https://material.angularjs.org/latest/#/demo/material.components.gridList
      .iconSet('avatars', 'https://raw.githubusercontent.com/angular/material/master/docs/app/icons/avatar-icons.svg', 24)
      .defaultIconSet('https://raw.githubusercontent.com/google/material-design-icons/master/sprites/svg-sprite/svg-sprite-action.svg', 24);
});
</script>



  </body>
</html>