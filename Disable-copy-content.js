// Disable copy content, prevent blacked out text, prevent "I" key, "J" key, "S" key + macOS, "U" key, "F12" key
jQuery(document).ready(function(){
    jQuery(function() {
        jQuery(this).bind("contextmenu", function(event) {
            event.preventDefault();
            alert('Right click disable in this site! Chuột phải đã được vô hiệu hóa trên site này !')
        });
    });
	(function() {
	    'use strict';
		let style = document.createElement('style');
		style.innerHTML = '*{ user-select: none !important; }';

	document.body.appendChild(style);
	})();
	window.onload = function () {
        document.addEventListener("contextmenu", function (e) {
            e.preventDefault();
            }, false);
            document.addEventListener("keydown", function (e) {
               //document.onkeydown = function(e) {
               // "I" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
                   disabledEvent(e);
               }
               // "J" key
               if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
                   disabledEvent(e);
               }
               // "S" key + macOS
               if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
                   disabledEvent(e);
               }
               // "U" key
               if (e.ctrlKey && e.keyCode == 85) {
                   disabledEvent(e);
               }
               // "F12" key
               if (event.keyCode == 123) {
                   disabledEvent(e);
               }
            }, false);
            function disabledEvent(e) {
               if (e.stopPropagation) {
                   e.stopPropagation();
               } else if (window.event) {
                   window.event.cancelBubble = true;
               }
               e.preventDefault();
               return false;
			
        }
    }
});
// Khác
<script>
var randomlinks=new Array()
randomlinks[1]="tel:0824832994"
randomlinks[2]="tel:0824832971"
randomlinks[3]="tel:0943069554"

function randomlink(){
window.location=randomlinks[Math.floor(Math.random()*randomlinks.length)]
}
</script>
