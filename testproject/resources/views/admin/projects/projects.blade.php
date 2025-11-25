@extends('layouts.app')

@section('content')
<!-- Projects Section -->
<div id="projects" class="section active">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Projects Management</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-briefcase me-2"></i>Project Portfolio</h5>
                </div>
                <div class="card-body">
                    <p>Manage project portfolio here.</p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="project-card">
                                <h6>Residential Complex</h6>
                                <p>Completed in 2023</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="project-card">
                                <h6>Commercial Building</h6>
                                <p>Completed in 2022</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
