(function(a){skel.breakpoints({xlarge:"(max-width: 1680px)",large:"(max-width: 1280px)",medium:"(max-width: 980px)",small:"(max-width: 736px)",xsmall:"(max-width: 480px)","xlarge-to-max":"(min-width: 1681px)","small-to-xlarge":"(min-width: 481px) and (max-width: 1680px)"});a(function(){var i=a(window),b=a("head"),h=a("body");h.addClass("is-loading");i.on("load",function(){setTimeout(function(){h.removeClass("is-loading")},100)});var g;i.on("resize",function(){h.addClass("is-resizing");clearTimeout(g);g=setTimeout(function(){h.removeClass("is-resizing")},100)});a("form").placeholder();skel.on("+medium -medium",function(){a.prioritize(".important\\28 medium\\29",skel.breakpoint("medium").active)});if(!skel.canUse("object-fit")||skel.vars.browser=="safari"){a(".image.object").each(function(){var k=a(this),j=k.children("img");j.css("opacity","0");k.css("background-image",'url("'+j.attr("src")+'")').css("background-size",j.css("object-fit")?j.css("object-fit"):"cover").css("background-position",j.css("object-position")?j.css("object-position"):"center")})}var f=a("#sidebar"),d=f.children(".inner");skel.on("+large",function(){f.addClass("inactive")}).on("-large !large",function(){f.removeClass("inactive")});if(skel.vars.os=="android"&&skel.vars.browser=="chrome"){a("<style>#sidebar .inner::-webkit-scrollbar { display: none; }</style>").appendTo(b)}if(skel.vars.IEVersion>9){a('<a href="#sidebar" class="toggle">Toggle</a>').appendTo(f).on("click",function(j){j.preventDefault();j.stopPropagation();f.toggleClass("inactive")})}f.on("click","a",function(k){if(!skel.breakpoint("large").active){return}var l=a(this),j=l.attr("href"),m=l.attr("target");k.preventDefault();k.stopPropagation();if(!j||j=="#"||j==""){return}f.addClass("inactive");setTimeout(function(){if(m=="_blank"){window.open(j)}else{window.location.href=j}},500)});f.on("click touchend touchstart touchmove",function(j){if(!skel.breakpoint("large").active){return}j.stopPropagation()});h.on("click touchend",function(j){if(!skel.breakpoint("large").active){return}f.addClass("inactive")});i.on("load.sidebar-lock",function(){var l,j,k;if(i.scrollTop()==1){i.scrollTop(0)}i.on("scroll.sidebar-lock",function(){var m,n;if(skel.vars.IEVersion<10){return}if(skel.breakpoint("large").active){d.data("locked",0).css("position","").css("top","");return}m=Math.max(l-j,0);n=Math.max(0,i.scrollTop()-m);if(d.data("locked")==1){if(n<=0){d.data("locked",0).css("position","").css("top","")}else{d.css("top",-1*m)}}else{if(n>0){d.data("locked",1).css("position","fixed").css("top",-1*m)}}}).on("resize.sidebar-lock",function(){j=i.height();l=d.outerHeight()+30;i.trigger("scroll.sidebar-lock")}).trigger("resize.sidebar-lock")});var e=a("#menu"),c=e.children("ul").find(".opener");c.each(function(){var j=a(this);j.on("click",function(k){k.preventDefault();c.not(j).removeClass("active");j.toggleClass("active");i.triggerHandler("resize.sidebar-lock")})})})})(jQuery);