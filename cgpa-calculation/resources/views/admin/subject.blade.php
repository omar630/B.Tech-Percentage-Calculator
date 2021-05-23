@extends('admin.layouts.app')
@section('content')
<!-- Header -->
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
              <li class="breadcrumb-item"><a href="#">Subjects</a></li>
            </ol>
          </nav>
        </div>
        <div class="col-lg-6 col-5 text-right">
          <a href="#" class="btn btn-sm btn-neutral" onclick="$('#add-subject-modal').modal('show')">New</a>
        </div>
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
        <!-- Light table -->
        <div class="table-responsive">
          <table class="table align-items-center table-flush" id="demo">
            <thead class="thead-light">
              <tr>
                <th scope="col">Subject</th>
                <th scope="col">year-Sem</th>
                <th scope="col">Branch</th>
                <th scope="col">Subject Type</th>
                <th scope="col">Credits</th>
                <th scope="col" class="sorting_1">Created_at</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody class="list">
              @foreach($subjects as $subject)
              <tr id="subject-{{ $subject->id }}">
                <th scope="row">
                  <div class="media align-items-center">
                    <div class="media-body">
                      <span class="name mb-0 text-sm" id="subject-{{ $subject->id }}-name" data-id="{{ $subject->id }}">{{ $subject->name }}</span>
                    </div>
                  </div>
                </th>
                <td>
                  <span class="badge badge-dot mr-4">
                    <span class="status" id="subject-{{ $subject->id }}-year" data-year="{{ $subject->year }}" data-sem="{{ $subject->sem }}">{{ $subject->year.'-'.$subject->sem }}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <span class="status" id="subject-{{ $subject->id }}-branch" data-branch-id = {{ $subject->branch->id }}>{{ $subject->branch->branch }}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <span class="status" id="subject-{{ $subject->id }}-subject-type" data-subject-type-id="{{ $subject->subjectType->id ?? null }}">{{ $subject->subjectType->name ?? '-'}}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $subject->credit }}</span>
                  </span>
                </td>
                <td>
                  <span class="badge badge-dot mr-4">
                    <i class="bg-success"></i>
                    <span class="status">{{ $subject->created_at->format('d-M-y g:i a') }}</span>
                  </span>
                </td>
                <td class="text-right">
                  <div class="dropdown">
                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                      <a class="dropdown-item" href="#" onclick="openEditModal({{ $subject->id }})">Edit</a>
                      <a class="dropdown-item" href="#" onclick="deleteSubject({{ $subject->id }})">Delete</a>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal for edit -->
<div class="modal fade" id="edit-subject-modal" tabindex="-1" role="dialog" aria-labelledby="edit-subject-modal" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-5">
            <form role="form" id="edit-subject-form" method="POST" action="{{ route('admin.subject.update.post') }}">
              <input class="form-control" type="hidden" name="subject_id">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni"></i></span>
                  </div>
                  <input class="form-control" placeholder="Subject" type="text" name="subject_name">
                </div>
              </div>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni"></i></span>
                  </div>
                  <input class="form-control" placeholder="credits" type="text" name="subject_credit">
                </div>
              </div>
              <div class="form-group">
                <label for="select-branch">Select Branch</label>
                <select class="form-control" id="select-branch" name="branch_id">
                  @foreach($branches as $branch)
                  <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="slect-year">Year</label>
                <select class="form-control" id="slect-year" name="subject_year">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
              <div class="form-group">
                <label for="select-sem">Semester</label>
                <select class="form-control" id="select-sem" name="subject_sem">
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>
              <div class="form-group">
                <label for="select-subject-type">Subject Type</label>
                <select class="form-control" id="select-subject-type" name="subject_type_id">
                  @foreach($subjectTypes as $subjectType)
                  <option value="{{ $subjectType->id }}">{{ $subjectType->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="select-regulation-type">Regulation</label>
                <select class="form-control" id="select-regulation-type" name="regulation_id">
                  @foreach($regulations as $regulation)
                  <option value="{{ $regulation->id }}">{{ $regulation->regulation }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal end for edit -->
<!-- modal for add -->
<div class="modal fade" id="add-subject-modal" tabindex="-1" role="dialog" aria-labelledby="add-modal" aria-hidden="true">
  <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-body p-0">
        <div class="card bg-secondary border-0 mb-0">
          <div class="card-header bg-transparent pb-5">
            <form role="form" id="add-branch-form" method="POST" action="{{ route('admin.subject.add.post') }}">
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni"></i></span>
                  </div>
                  <input class="form-control" placeholder="Subject" type="text" name="subject_name">
                </div>
              </div>
              <div class="form-group mb-3">
                <div class="input-group input-group-merge input-group-alternative">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="ni"></i></span>
                  </div>
                  <input class="form-control" placeholder="credits" type="text" name="subject_credit">
                </div>
              </div>
              <div class="form-group">
                <label for="select-branch">Select Branch</label>
                <select class="form-control" id="select-branch" name="branch_id">
                  @foreach($branches as $branch)
                  <option value="{{ $branch->id }}">{{ $branch->branch }}</option>
                  @endforeach
                </select>
              </div>

              <div class="form-group">
                <label for="slect-year">Year</label>
                <select class="form-control" id="slect-year" name="subject_year">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                </select>
              </div>
              <div class="form-group">
                <label for="select-sem">Semester</label>
                <select class="form-control" id="select-sem" name="subject_sem">
                  <option value="1">1</option>
                  <option value="2">2</option>
                </select>
              </div>
              <div class="form-group">
                <label for="select-subject-type">Subject Type</label>
                <select class="form-control" id="select-subject-type" name="subject_type_id">
                  @foreach($subjectTypes as $subjectType)
                  <option value="{{ $subjectType->id }}">{{ $subjectType->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="select-regulation-type">Regulation</label>
                <select class="form-control" id="select-regulation-type" name="regulation_id">
                  @foreach($regulations as $regulation)
                  <option value="{{ $regulation->id }}">{{ $regulation->regulation }}</option>
                  @endforeach
                </select>
              </div>
              <div class="text-center">
                <button type="submit" class="btn btn-primary my-4">Save</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- modal end for add -->
@endsection
@section('js')
<script language="javascript" type="text/javascript">
  function openEditModal(subject_id, branch){
    $('#edit-subject-modal input[name="subject_name"]').val(branch);
    $('#edit-subject-modal input[name="subject_id"]').val(subject_id);
    $('#edit-subject-modal').modal('show');
  }

  function deleteSubject(subject_id) {
    $.ajax({
      type: "DELETE",
      url: "{{ route('admin.subject.delete.post') }}",
      data: {
        "subject_id": subject_id,
      },
      success: function(data) {
        if(data.error == false) {
          location.reload();
        }
      }
    });
  }

  $('#edit-subject-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(e.target);
    $.ajax({
      type: "POST",
      url: $(form).attr('action'),
      data: {
        "subject_id": $(form).find("input[name='subject_id']").val(),
        "subject_name": $(form).find("input[name='subject_name']").val()
      }
    });
  })
  $('#add-branch-form').on('submit', function(e) {
    e.preventDefault();
    var form = $(e.target);
    $.ajax({
      type: "PUT",
      url: $(form).attr('action'),
      data: $(form).serialize(),
      success: function(data) {
        if(data.error == false) {
          location.reload();
        }
      }
    });
  })
  $(document).ready(function(){
    $('#demo').DataTable({
      columnDefs: [ { type: 'date', 'targets': [6] } ],
      order: [[ 6, 'desc' ]]
    });
  })
</script>
@endsection