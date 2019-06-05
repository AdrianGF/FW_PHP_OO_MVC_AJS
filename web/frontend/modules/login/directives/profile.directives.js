unlimty.directive('dropzone', function () {
    return function (scope, element, attrs) {
      var config, dropzone;
  
      config = scope[attrs.dropzone];
  
      // create a Dropzone for the element with the given options
      dropzone = new Dropzone(element[0], config.options);
  
      // bind the given event handlers
      angular.forEach(config.eventHandlers, function (handler, event) {
        dropzone.on(event, handler);
      });
    };
  });

unlimty.directive('datepickerp', function () {
    return {
      require: 'ngModel',
      link: function (scope, el, attr, ngModel) {
          $(el).datepicker({
              dateFormat: 'mm/dd/yy',
              changeMonth:true,
              changeYear:true,
              yearRange:"1900:2020",
              maxDate:0,
              onSelect: function (dateText) {
                  scope.$apply(function () {
                      ngModel.$setViewValue(dateText);
                  });
              }
          });
      }
  };
});