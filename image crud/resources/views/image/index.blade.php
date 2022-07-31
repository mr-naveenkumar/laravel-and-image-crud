<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Table</h1>

    <div class="table-responsive">
        <table class="table caption-top">
            <caption>List of users</caption> 
                   @if(session("update-message"))
                          <div class="alert alert-danger">
                                  <h>{{session("update-message")}}</h>
                           </div> 
                   @endif

                   @if(session("delete-message"))
                          <div class="alert alert-danger">
                                  <h>{{session("delete-message")}}</h>
                           </div> 
                   @endif
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
               <a href="{{url('create-page')}}" ><button class="btn btn-primary me-md-2" type="button">Create</button> </a>
                
              </div>
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Image</th>
                <th scope="col">Edit</th>
                <th scope="col">Delete</th>
              </tr>
            </thead>
            <tbody>
            @foreach($imageView as $imageList)
              <tr>
                <th scope="row">{{$imageList->id}}</th>
                <td>{{$imageList->name}}</td>
                <td><img src="images/{{$imageList->profile_image}}" width="100px" height="100px"/></td>
                <td> <a href="{{url('edit-image',['id'=>$imageList->id])}}"><button type="button" class="btn btn-primary">Edit</button></a></td>
                <td> {{-- <a href="{{route('post.delete',['id'=>$imageList->id])}}" ><button type="button" class="btn btn-danger">Delete</button> --}}
                 <form  method="post" action="{{route('post.delete',['id'=>$imageList->id])}}"  enctype="multipart/form-data">
                   @csrf
                   @method("DELETE")
                  
                             <button  class="btn btn-danger" type="submit">Delete</button>
                   </form> 
            </td> 
                  </tr>
                  @endforeach
            </tbody>
          </table>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" ></script>
  </body>
</html>