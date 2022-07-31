<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" >
  <!-- <meta name="csrf-token" content="{{csrf_token()}}"> this will not work beacuse it is update request is put so 
  use @csrf -->  
</head>
  <body>
    <h1>Edit!</h1>
    
<div class="container">
    <h2>Please input data here</h2>
    <p>So here is only name and image fields</p>
    @if(session("status"))
    <div class="alert alert-success">
      <p>{{session("status")}} </p>
    </div>
    @endif
    <!-- here down id is coming from editImage() function -->
    <form method="post" action="{{url('update-image/'.$images->id)}}" enctype="multipart/form-data">
        @csrf
            @method("PUT")
   
   <!--         <input type="hidden" name="id" value="images->id" /> <br>  -->
              <div class="form-group">
                 <label for="usr">Name:</label>
              <input type="text" class="form-control" name="name" id="usr" value="{{$images->name}}"/>
               </div>
                             @error("name")
                             <div class="alert alert-danger">
                                 <p> {{$message}}  </p>
                              </div>
                             @enderror
          <div class="mb-3">
                <label for="formFile" class="form-label">Image</label>
                       <input class="form-control" type="file" name="profile_image" id="formFile" />
                       <!-- if access from other than index page use asset in laravel down like -->
                       <img src="{{asset('images/'.$images->profile_image)}}" width="100px" height="100px"/>
          </div>
                            @error("profile_image")
                                 <div class="alert alert-danger">
                                    <p> {{$message}}  </p>
                                 </div>
                            @enderror
      <div class="form-group">        
        </div>
      <br>
      <button class="btn btn-primary" type="submit" >submit</button>
    </form>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>