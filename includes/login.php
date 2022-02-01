<div class="row">
    <div class="col-sm-4"></div>
    <!-- Login Card -->
    <div class="col-sm-4">
        <div class="card mx-auto rounded-10">    
            <div class="card-header text-white bg-primary">
                <h2 class="card-title text-center"><?php echo str_replace("'","\'",$config['title']); ?> Login</h2>
            </div>
            <div class="card-body">
                <!-- Login Form -->
                <form class="animate" action="index.php?login" method="post">
                    <div class="form-group login">
                        <label for="username">  <i class="bi bi-person-fill"></i> Username</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Enter username">
                    </div>
                    <div class="form-group login">
                        <label for="password">  <i class="bi bi-lock-fill"></i> Password</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                    </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" name="employee_submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>