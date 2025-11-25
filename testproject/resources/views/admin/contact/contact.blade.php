@extends('layouts.app')

@section('content')
<!-- Contact Section -->
<div id="contact" class="section active">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Contact Management</h1>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5><i class="bi bi-envelope me-2"></i>Contact Information</h5>
                </div>
                <div class="card-body">
                    <p>Manage contact information and inquiries.</p>
                    <div class="row">
                        <div class="col-md-4">
                            <h6>Phone</h6>
                            <p>+1 (555) 123-4567</p>
                        </div>
                        <div class="col-md-4">
                            <h6>Email</h6>
                            <p>info@contractor.com</p>
                        </div>
                        <div class="col-md-4">
                            <h6>Address</h6>
                            <p>123 Construction Ave, City, State 12345</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
