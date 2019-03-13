$(document).ready(function () {
    var flag=true;
    $("#nav").click(function(){
        if(flag){
            flag=false;
            $(this).css({
                transition:"transform 1s",
                webkitTransition:"transform 1s",
                oTransition:"transform 1s",
                msTransition:"transform 1s",
                mozTransition:"transform 1s",

                transform:"scale(1.5)",
                webkitTransform:"scale(1.5)",
                oTransform:"scale(1.5)",
                msTransform:"scale(1.5)",
                mozTransform:"scale(1.5)"
            });
            $("#out").css({
                transition:"margin-left 1s, margin-top 1s",
                webkitTransition:"margin-left 1s, margin-top 1s",
                oTransition:"margin-left 1s, margin-top 1s",
                msTransition:"margin-left 1s, margin-top 1s",
                mozTransition:"margin-left 1s, margin-top 1s",

                marginLeft:"-350px",
                marginTop:"-350px"
            });
            $("#first").css({
                transition:"left 1.2s,top 1.2s",
                webkitTransition:"left 1.2s,top 1.2s",
                oTransition:"left 1.2s,top 1.2s",
                msTransition:"left 1.2s,top 1.2s",
                mozTransition:"left 1.2s,top 1.2s",

                left:"200px",
                top:"15px"
            });
            $("#second").css({
                transition:"left 1.5s,top 1.5s",
                webkitTransition:"left 1.5s,top 1.5s",
                oTransition:"left 1.5s,top 1.5s",
                msTransition:"left 1.5s,top 1.5s",
                mozTransition:"left 1.5s,top 1.5s",
                left:"150px",
                top:"150px"
            });
            $("#third").css({
                transition:"left 1.8s,top 1.8s",
                webkitTransition:"left 1.8s,top 1.8s",
                oTransition:"left 1.8s,top 1.8s",
                msTransition:"left 1.8s,top 1.8s",
                mozTransition:"left 1.8s,top 1.8s",
                left:"20px",
                top:"210px"
            });
        }else{
            flag=true;
            $(this).css({
                transition:"transform 1s",
                webkitTransition:"transform 1s",
                oTransition:"transform 1s",
                msTransition:"transform 1s",
                mozTransition:"transform 1s",

                transform:"scale(1)",
                webkitTransform:"scale(1)",
                oTransform:"scale(1)",
                mozTransition:"scale(1)",
                msTransform:"scale(1)"
            });
            $("#out").css({
                transition:"margin-left 0.5s, margin-top 0.5s",
                webkitTransition:"margin-left 0.5s, margin-top 0.5s",
                oTransition:"margin-left 0.5s, margin-top 0.5s",
                msTransition:"margin-left 0.5s, margin-top 0.5s",
                mozTransition:"margin-left 0.5s, margin-top 0.5s",
                marginLeft:"-550px",
                marginTop:"-550px"
            });
            $("#first").css({
                transition:"left 1s,top 1s",
                webkitTransition:"left 1s,top 1s",
                oTransition:"left 1s,top 1s",
                msTransition:"left 1s,top 1s",
                mozTransition:"left 1s,top 1s",
                left:"-100px",
                top:"-100px"
            });
            $("#second").css({
                transition:"left 1s,top 1s",
                webkitTransition:"left 1s,top 1s",
                oTransition:"left 1s,top 1s",
                msTransition:"left 1s,top 1s",
                mozTransition:"left 1s,top 1s",
                left:"-100px",
                top:"-100px"
            });
            $("#third").css({
                transition:"left 1s,top 1s",
                webkitTransition:"left 1s,top 1s",
                oTransition:"left 1s,top 1s",
                msTransition:"left 1s,top 1s",
                mozTransition:"left 1s,top 1s",
                left:"-100px",
                top:"-100px"
            });
        }
    });
});


