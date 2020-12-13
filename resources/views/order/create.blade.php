@extends('app')
@section('title', 'Orders')

@section('content')

<h2>Create New Order</h2>
<br>
<div class="container">
    <form method="POST" action="{{route('dashboard.orders.store')}}">
@csrf
    <div class="form-group px-5">
    <label for="exampleFormControlSelect1">User</label>
    <select class="form-control mb-4" id="userSelect" name="order_user_id">
      <option ></option>
      @foreach ($users as $user)
       <option value="{{$user->id}}">{{$user->name}}</option>
      @endforeach
    </select>
  </div>
  <label class="px-5">Medicines:</label>
  <div class="container px-5 medicineContainer">
    <div class="row medicineRow">
      <div class="col-4 medicineNameContainer">
        <label for="exampleFormControlInput1">Medicine Name</label>
        <select name="med_name[]" class="form-control mb-4 medicineNameSelect">
          <option value=""></option>
          @foreach ($medicines_unique_names as $medicines_unique_name)
          <option value="{{$medicines_unique_name->name}}">{{$medicines_unique_name->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-3 medTypeContainer">
        <label for="">Medicine Type</label>
        <select name="med_type[]"  class="form-control mb-4 medicineTypeSelect">
          <option ></option>
          @foreach ($medicines_unique_types as $medicines_unique_type)
          <option value="{{$medicines_unique_type->type}}">{{$medicines_unique_type->type}}</option>
         @endforeach
        </select>
      </div>
      <div class="col-2 medQuanityContainer">
        <label for="">Quantity</label>
      <input type="number" name="med_quantity[]" class="form-control mb-4 quantity" >
      </div>
      <div class="col-2 medPriceContainer">
        <label for="">Price</label>
      <input type="number" name="med_price[]"class="form-control mb-4 price" >
      </div>
      <div class="col-1 my-4 addMedBtnContainer">
        <button class="btn btn-success add" id="addMedBtn" type="button">+</button>
        <button class="btn btn-danger delete" type='button'>X</button>
      </div>
    </div>


  </div>

  <div class="form-group px-5">
    <label for="" >is insured</label>
    <input type="checkbox" name="is_insured" value='1'>
  </div>
  <div class="form-group px-5">
    <label for="exampleFormControlInput1">Statues</label>
    <select name="status_id"  class="form-control  @auth('admin') {{ 'disabled' }} @endauth" >
      @foreach ($statuses as $key =>$value)
      <option value={{$value}} >{{$key}}</option>
      @endforeach

    </select>
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-success d-block mx-auto" style="width:80%;">Order</button>
  </div>

</form>

</div>

<div class="container">
  <div class="row text-right">
    <div class="col">
      <p>Total Price: <span id="totalPrice"></span></p>
    </div>
  </div>
</div>

<select name="med_name[]" class="form-control mb-4 medData d-none">
  <option ></option>
  @foreach ($medicines_unique_names as $medicines_unique_name)
   <option value="{{$medicines_unique_name->name}}">{{$medicines_unique_name->name}}</option>
  @endforeach
</select>

<select name="med_type[]" class="form-control mb-4 typeData d-none">
  <option ></option>
  @foreach ($medicines_unique_types as $medicines_unique_type)
   <option value="{{$medicines_unique_type->type}}">{{$medicines_unique_type->type}}</option>
  @endforeach
</select>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@endsection

@section('script')
     <!-- Select2 -->
     <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
     <!-- medicine creation form -->
   <script src="{{ asset('js/medicine.js')}}"></script>
@endsection
