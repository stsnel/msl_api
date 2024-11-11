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
            if(this.dataset.uris !== undefined) {
                let matchedUris = JSON.parse(this.dataset.uris);
                if(Array.isArray(matchedUris)) {
                    matchedUris.forEach((uri) => {
                        $("div[data-uri=\"" + uri + "\"]").addClass("bg-info-300");
                    });
                }
            }
        }, function() {
            if(this.dataset.uris !== undefined) {
                let matchedUris = JSON.parse(this.dataset.uris);    
                if(Array.isArray(matchedUris)) {
                    matchedUris.forEach((uri) => {
                        $("div[data-uri=\"" + uri + "\"]").removeClass("bg-info-300");
                    });
                }
            }
        }
    )

    $('[data-highlight=text-keyword]').hover(
        function() {
            let tagsMatched = false;
            let originalKeywordsMatched = false;        
            let tags;

            tags = document.querySelectorAll('[data-highlight="tag"]');
            tags.forEach((tag) => {
                let tagData = JSON.parse(tag.dataset.uris);
                tagData.forEach((uri) => {
                    if(uri == this.dataset.uri) {
                        tag.classList.add('bg-info-300');
                        tagsMatched = true;
                    }
                });                                
            });
    
            $("span[data-uris*=\"" + this.dataset.uri + "\"]").addClass("bg-info-300");
    
            $("div[data-uri=\"" + this.dataset.uri + "\"]").addClass("bg-info-300");
            if($("#corresponding-keywords-panel div[data-uri=\"" + this.dataset.uri + "\"]").length > 0) {
                originalKeywordsMatched = true;
            }
    
            if(this.dataset.matchedChildUris !== undefined) {
                let matchedChildUris = JSON.parse(this.dataset.matchedChildUris);
    
                if(Array.isArray(matchedChildUris)) {
                    matchedChildUris.forEach((childUri) => {
                        $("div[data-uri=\"" + childUri + "\"]").addClass("bg-info-300");
                        if(!originalKeywordsMatched) {
                            if($("#corresponding-keywords-panel div[data-uri=\"" + childUri + "\"]").length > 0) {
                                originalKeywordsMatched = true;
                            }
                        }
    
                        $("div[data-uris*='\"" + childUri + "\"']").addClass("bg-info-300");
                        if(!tagsMatched) {
                            if($("div[data-uris*='\"" + childUri + "\"']").length > 0) {
                                tagsMatched = true;
                            }
                        }
    
                        $("span[data-uris*='\"" + childUri + "\"']").addClass("bg-info-300");
                    });
                }
            }
                
            if(tagsMatched) {
                if($('#original-keywords-panel').attr('open') !== 'open') {
                    $('#original-keywords-panel').addClass("bg-info-300");
                }
            }

            if(originalKeywordsMatched) {                        
                if($('#corresponding-keywords-panel').attr('open') !== 'open') {
                    $('#corresponding-keywords-panel').addClass("bg-info-300");
                }
            }                            
        }, function() {
            let tagsMatched = false;
            let originalKeywordsMatched = false;
            let tags;

            tags = document.querySelectorAll('[data-highlight="tag"]');
            tags.forEach((tag) => {
                let tagData = JSON.parse(tag.dataset.uris);
                tagData.forEach((uri) => {
                    if(uri == this.dataset.uri) {
                        tag.classList.remove('bg-info-300');
                        tagsMatched = true;
                    }
                });                                
            });
    
            $("span[data-uris*=\"" + this.dataset.uri + "\"]").removeClass("bg-info-300");
    
            $("div[data-uri=\"" + this.dataset.uri + "\"]").removeClass("bg-info-300");
            if($("#corresponding-keywords-panel div[data-uri=\"" + this.dataset.uri + "\"]").length > 0) {
                originalKeywordsMatched = true;
            }
    
            if(this.dataset.matchedChildUris !== undefined) {
                let matchedChildUris = JSON.parse(this.dataset.matchedChildUris);
    
                if(Array.isArray(matchedChildUris)) {
                    matchedChildUris.forEach((childUri) => {
                        $("div[data-uri=\"" + childUri + "\"]").removeClass("bg-info-300");
                        if(!originalKeywordsMatched) {
                            if($("#corresponding-keywords-panel div[data-uri=\"" + childUri + "\"]").length > 0) {
                                originalKeywordsMatched = true;
                            }
                        }
    
                        $("div[data-uris*='\"" + childUri + "\"']").removeClass("bg-info-300");
                        if(!tagsMatched) {
                            if($("div[data-uris*='\"" + childUri + "\"']").length > 0) {
                                tagsMatched = true;
                            }
                        }
    
                        $("span[data-uris*='\"" + childUri + "\"']").removeClass("bg-info-300");
                    });
                }
            }
    
            if(tagsMatched) {
                $('#original-keywords-panel').removeClass("bg-info-300");
            }
    
            if(originalKeywordsMatched) {
                $('#corresponding-keywords-panel').removeClass("bg-info-300");
            }
        }
      )
});