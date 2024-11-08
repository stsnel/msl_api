$(document).ready(function() {

    $('[data-toggle=domain-highlight]').hover(        
        function() {
            $("div[data-associated-subdomains*='\"" + this.dataset.domain + "\"']").addClass("bg-info-300");
        }, function() {
            $("div[data-associated-subdomains*='\"" + this.dataset.domain + "\"']").removeClass("bg-info-300");
        }
    )

    $('[data-highlight=tag]').hover(
        function() {
            if(this.dataset.uri !== undefined) {
                let matchedUris = JSON.parse(this.dataset.uri);
                if(Array.isArray(matchedUris)) {
                    matchedUris.forEach((uri) => {
                        $("div[data-uri=\"" + uri + "\"]").addClass("bg-info-300");
                        $("div[data-uris*='\"" + uri + "\"']").addClass("bg-info-300");
                    });
                }
            }
        }, function() {
            if(this.dataset.uri !== undefined) {
                let matchedUris = JSON.parse(this.dataset.uri);    
                if(Array.isArray(matchedUris)) {
                    matchedUris.forEach((uri) => {
                        $("div[data-uri=\"" + uri + "\"]").removeClass("bg-info-300");
                        $("div[data-uris*='\"" + uri + "\"']").removeClass("bg-info-300");
                    });
                }
            }
        }
      )
});