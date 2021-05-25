@extends('admin.layouts.app')
@section('content')
<!-- Header -->
<div class="header bg-primary pb-6">
  <div class="container-fluid">
    <div class="header-body">
      <div class="row align-items-center py-4">
        <div class="col-lg-6 col-7">
          <h6 class="h2 text-white d-inline-block mb-0">Subject</h6>
          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
              <li class="breadcrumb-item"><a href="#">Upload Academic Excel</a></li>
            </ol>
          </nav>
        </div>
        {{-- <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral" onclick="$('#add-subject-modal').modal('show')">New</a>
        </div> --}}
      </div>
    </div>
  </div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Subject</h3>
        </div>
        <div class="card-body">
          <form id="upload-excel" method="POST" enctype="multipart/form-data" action="{{ route('admin.upload-subjects-excel.post') }}">
            @csrf
            <div class="form-group">
            <div class="custom-file">
              <input type="file" class="custom-file-input" id="customFileLang" lang="en" name="subjects" accept=".xlsx">
              <label class="custom-file-label" for="customFileLang">Select file</label>
            </div>
            </div>
             <button class="btn btn-icon btn-primary" type="submit">
            <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
            <span class="btn-inner--text">Fetch Subjects</span>
          </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <div class="card">
        <!-- Card header -->
        <div class="card-header border-0">
          <h3 class="mb-0">Subject</h3>
        </div>
        <div class="card-body">
          <form id="subjects-form">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Regulation / Branch</span>
                </div>
                {{-- {{ dd($regulations) }} --}}
                <select class = "form-control"  name="regulation" id="regulation">
                  @foreach($regulations as $regulation)
                  <option value="{{ $regulation->id }}">{{ $regulation->regulation }}</option>
                  @endforeach
                </select>
                <select class = "form-control" name="branch" id="branch">
                  @foreach($branches as $branch)
                  <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </form>
          <button class="btn btn-icon btn-primary" type="button" onclick="saveSubjects()">
            <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
            <span class="btn-inner--text">Save</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
@section('js')
<script>
  function makeid(l){
      var text = "";
      var char_list = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      for(var i=0; i < l; i++ ){
        text += char_list.charAt(Math.floor(Math.random() * char_list.length));
      }
      return text;
    }
  $('#upload-excel').on('submit', function(e){
    e.preventDefault();
    var form = $(e.target);
    form = new FormData( this )
    console.log(form);

    $.ajax({
      type: "POST",
      url: "{{ route('admin.upload-subjects-excel.post') }}",
      data: form,
      processData: false,
      contentType: false,
      success: function(data) {
        console.log(data);
        populateSubjects(data);
      }
    });
  });
  function populateSubjects(data) {
    var form = $('#subjects-form');
    // $(form).empty();
    $(form).append(populateYearSem(data.message, 1));
    $('#regulation option[value="'+data.message.data.regulation_id+'"]').prop('selected', true);
    $('#branch option[value="'+data.message.data.branch_id+'"]').prop('selected', true);
    data.message.sem1.forEach(function(el, indx){
      id = makeid(4);
      $(form).append(`<div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Subject and Credits</span>
          </div>
          <input type="text" aria-label="Subject" class="form-control" value="${el.subject}" name="subject-sem1-${id}">
          <input type="text" aria-label="Credit" class="form-control" value="${el.credit}" name="credit-${id}">
        </div>
      </div>`);
    })

    $(form).append(populateYearSem(data.message, 2));
    data.message.sem2.forEach(function(el, indx){
      id = makeid(4);
      $(form).append(`<div class="form-group">
        <div class="input-group">
          <div class="input-group-prepend">
            <span class="input-group-text">Subject and Credits</span>
          </div>
          <input type="text" aria-label="Subject" class="form-control" value="${el.subject}" name="subject-sem2-${id}">
          <input type="text" aria-label="Credit" class="form-control" value="${el.credit}" name="credit-${id}">
        </div>
      </div>`);
    })
  }
  function populateYearSem(data, sem) {
    var form = `<div class="form-group">
      <div class="input-group">
        <div class="input-group-prepend">
          <span class="input-group-text">Year / Sem</span>
        </div>
        <input type="text" aria-label="Year" class="form-control" name="year" value="${data.data.year}">
        <input type="text" aria-label="Sem" class="form-control" name="sem" value="${sem}">
      </div>
    </div>`;
    return form;
  }

  function saveSubjects() {
    var data = $('#subjects-form').serialize();
    $.ajax({
      type: "GET",
      data: data,
      url: "{{ route('admin.save-subjects.post') }}",
      success: function(data){
        console.log(data);
      }
    })
    console.log();
  }
</script>
@endsection