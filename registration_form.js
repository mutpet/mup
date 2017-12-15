var item_width = 200;
var akt_item = 0;
var face_img_item_count ;

var step = 10;
var showed_items = 7;

var one_item = null;


    if ($('face_content') != null) {
        

    $('jobbra_link').addEvent('click', (facejobbra));
    $('balra_link').addEvent('click', (facebalra));

    calc_items();
            
}
function calc_items() {
    
     face_img_item_count=1;
     
     var allPageTags = document.getElementsByTagName("td");
 
     for (i = 0; i < allPageTags.length; i++) {
         if (allPageTags[i].className == 'face_box') {
             face_img_item_count++;
 
             one_item = allPageTags[i];
         }
     }
     
    
    
     face_img_item_count--;
         
 
     
     item_width = 59;
       
          
    
 
     $('face_content').style.width = (face_img_item_count * item_width) + "px";
 }
 
 function Scroll(akt_pos_par, next_pos_par, dir_par) {
     scrolltimer = null;
 
     
 
 
     $('face_content').style.left = (akt_pos_par) + "px";
 
     if (dir_par == "dn") {
         if (akt_pos_par > next_pos_par) {
             // akt_pos_par=akt_pos_par-(step+1);
             akt_pos_par = akt_pos_par - (step);
             scrolltimer = setTimeout("Scroll(" + akt_pos_par + ", "
                 + next_pos_par + ", '" + dir_par + "')", 1);
         } else if (akt_item < (face_img_item_count - showed_items)) {
     // $('jobbra_link').className="spotlight_jobbra_act";
     }
 
     }
     if (dir_par == "up") {
         if (akt_pos_par < next_pos_par) {
             // akt_pos_par=akt_pos_par+(step+1);
             akt_pos_par = akt_pos_par + (step);
             scrolltimer = setTimeout("Scroll(" + akt_pos_par + ", "
                 + next_pos_par + ", '" + dir_par + "')", 1);
         } else if (akt_item > 0) {
     // $('balra_link').className="spotlight_balra_act";
     }
 
     }
 }
 function verScroll(dir, lp) {
    
    var size = $('spotlight_belso').getSize();
    
    
    if (size.x<400)
    {
        showed_items=4;
    }
    
    var oDiv, oContent;
    if (typeof dir != "undefined")
        direction = dir;

    if (typeof lp != "undefined")
        loop = lp;

    if (document.getElementById) {
        oDiv = $('spotlight_belso');
        oContent = $('face_content');
    } else {
        return;
    }

    if (direction == "dn") {

        // $('debug').set('html',
        // $('debug').get('html')+"<br>----------------------");
        // $('jobbra_link').className="spotlight_jobbra";
                
                 
        if (akt_item < (face_img_item_count - showed_items)) {
            $('balra_link').className = "spotlight_balra_act";
            akt_pos = 0 - (item_width * akt_item);
            // akt_item++;
            akt_item = akt_item + showed_items;
            next_pos = 0 - ((item_width * akt_item));
            Scroll(akt_pos, next_pos, direction);
        }
                
                    

    } else {
        if (direction == "up") {
            // $('balra_link').className="spotlight_balra";
            if (akt_item > 0) {

                $('jobbra_link').className = "spotlight_jobbra_act";
                akt_pos = 0 - (item_width * akt_item);
                akt_item = akt_item - showed_items;
                next_pos = 0 - (item_width * akt_item);
                Scroll(akt_pos, next_pos, direction);
            }

        }
    }
}

var scrolltimer, direction = "dn", loop = true;

function facejobbra() {

    verScroll('dn', false);
}
function facebalra() {
    verScroll('up', false);
}

