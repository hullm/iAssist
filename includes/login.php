<div class="container" style="padding-top: 10%;">
    <div class="row" style="padding-bottom: 20px;">
        <div class="col-xl-4 col-lg-4"></div>
        <!-- Login Card -->
        <div class="col-xl-4 col-lg-4">
            <div class="card mx-auto rounded-10 shadow" style="padding-top: 20px;"> 
                <div class="form-logo">
                    <img src="images/LGLogo.png"  height="90" alt="logo">
                </div>
                <div class="form-greeting">
                    <h2 class="card-title text-center">Sign in</h2>
                    <!-- <h2 class="card-title text-center"><img src="images/icon.png"  height="40" class="d-inline-block align-top" alt=""> Login</h2> -->
                </div>
                <div class="card-body">
                    <!-- Login Form -->
                        <form class="animate" action="index.php?login" method="post">
                            <div class="form-group login field-wrapper">
                                <input type="text" class="form-control" name="username" id="username">
                                <div class="field-placeholder"><span>Username</span></div>
                            </div>
                            <div class="form-group login field-wrapper">
                                <input type="password" class="form-control" name="password" id="password">
                                <div class="field-placeholder"><span>Password</span></div>
                            </div>
                        <div>
                </div>
                <div class="text-right form-button">
                    <!-- <button type="submit" name="employee_submit" class="btn btn-primary">Login</button> -->
                    <button type="submit" name="employee_submit" class="btn btn-primary">Login</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
$(function () {

$(".field-wrapper .field-placeholder").on("click", function () {
    $(this).closest(".field-wrapper").find("input").focus();
});
$(".field-wrapper input").on("keyup", function () {
    var value = $.trim($(this).val());
    if (value) {
        $(this).closest(".field-wrapper").addClass("hasValue");
    } else {
        $(this).closest(".field-wrapper").removeClass("hasValue");
    }
});

});
</script>