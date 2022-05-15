<meta name="csrf-token" content="{{ csrf_token() }}">
<form action="http://127.0.0.1:8000/api/login" method="post">
                @csrf
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent text-white"><i class="ti-user"></i></span>
                        </div>
                        <input type="email" id="email" name="email" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text  bg-transparent text-white"><i class="ti-lock"></i></span>
                        </div>
                        <input type="password" id="password" name="password" class="form-control pl-15 bg-transparent text-white plc-white" placeholder="Password">
                    </div>
                </div>
                    <div class="row">
                    <div class="col-6">
                        <div class="checkbox text-white">
                        <input type="checkbox" id="basic_checkbox_1" >
                        <label for="basic_checkbox_1">Remember Me</label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-6">
                        <div class="fog-pwd text-right">
                        <a href="javascript:void(0)" class="text-white hover-info"><i class="ion ion-locked"></i> Forgot pwd?</a><br>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-info btn-rounded mt-10">SIGN IN</button>
                    </div>
                    <!-- /.col -->
                    </div>
                    
            </form>	