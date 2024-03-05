@extends('template')

@section('body')
<div class="card text-center">
    <div class="card-header">
        Create Invoice
    </div>
    <div class="card-body">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <form action="{{ route('workspace.invoices.postShowAdd') }}" method="POST">
                @csrf
              <a href="#" style="text-decoration: none;">
              <div class="card h-100 cardForm card1" onclick="setActiveCard(this)">
                <div class="card-body">
                  <h5 class="card-title">An existing project</h5>
                  <p class="card-text">Choose an existing project and client to populate your invoice. If you used time tracking, you can invoice your tracked time.</p>
                </div>
                <div class="card-footer">
                  <div class="position-relative">
                    <select class="form-control mt-1" name="id_project" id="id_project" onchange="checkInputValues()">
                      <option value="">Select Project</option>
                      @foreach ($project as $projectmodels)
                          @if ($projectmodels->user_id == auth()->user()->id)
                              <option value="{{ $projectmodels->id }}">{{ $projectmodels->project_name }}</option>
                          @endif
                      @endforeach
                  </select>
                      <div class="position-absolute end-0 top-50 translate-middle-y">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 14L6.80385 9.5L17.1962 9.5L12 14Z" fill="#222325"></path>
                        </svg>
                    </div>
                  </div>
                </div>
  
              </div>
              </a>
            </div>
            <a href="#" style="text-decoration: none;">
            <div class="col">
              <div class="card h-100 cardForm card2" onclick="setActiveCard(this)">
                <div class="card-body">
                  <h5 class="card-title">A new project</h5>
                  <p class="card-text">Create an invoice and set up a new project and client based on the info. This way you can better keep track of your work and send future invoices more easily.</p>
                </div>
                <div class="card-footer">
                  <input type="text" class="form-control" name="project_name" id="project_name" placeholder="Project Name" oninput="checkInputValues()" onblur="checkInputValues()">
                </div>
              </div>
            </div>
            </a>
            <a href="#" style="text-decoration: none;">
            <div class="col">
              <div class="card h-100 cardForm card3"  onclick="setActiveCard(this)">
              
                <div class="card-body">
                  {{-- <h5 class="card-title">Card title</h5> --}}
                  <h5 class="card-title">Just a quick invoice</h5>
                  <p class="card-text">Create an invoice from scratch without creating a project to track time or expenses. Just add some line items and you are good to go.</p>
                </div>
                <div class="card-footer">
                  <small class="text-body-secondary"></small>
                </div>
              </div> 
            </div>
            </a>
          </div>
    </div>
    <div class="card-footer text-body-secondary">
        <p id="errorMessage" style="display: none;" class="text-danger">Please choose one!</p>
        <button id="nextButton" type="button" class="btn btn-primary"  onclick="sendData()" disabled>Next</button>
    </div>
  </form>
  </div>

  <script>
       let activeCard = null;

function setActiveCard(card) {
    if (activeCard !== null) {
        activeCard.classList.remove('active');
    }
    card.classList.add('active');
    activeCard = card;
    checkInputValues();
}

function checkInputValues() {
    const idProject = document.getElementById('id_project').value;
    const projectName = document.getElementById('project_name').value;
    const nextButton = document.getElementById('nextButton');
    const errorMessage = document.getElementById('errorMessage');

    if ((idProject.trim() !== '' || projectName.trim() !== '') && activeCard !== null) {
        nextButton.disabled = false;
    } else {
        nextButton.disabled = true;
        if (idProject.trim() === '' || projectName.trim() === '') {
          errorMessage.style.display = 'none';
        } else {
          errorMessage.style.display = 'block';
        }
    }
}
  </script>

@endsection
