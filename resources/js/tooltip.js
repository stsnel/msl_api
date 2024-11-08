$(document).ready(function() {

    $('[data-toggle=domain-highlight]').hover(        
        function() {
            $("div[data-associated-subdomains*='\"" + this.dataset.domain + "\"']").addClass("bg-info-300");
        }, function() {
            $("div[data-associated-subdomains*='\"" + this.dataset.domain + "\"']").removeClass("bg-info-300");
        }
      )
});