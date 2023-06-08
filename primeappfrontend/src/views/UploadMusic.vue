<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">Prime</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Featured</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Artists</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Music</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Player</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/uploadMusic">Upload Music</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row ">
            <div class="col-6 shadow p-5 mx-auto mt-5">
                <h3 class="text-center">Upload your music</h3>
                <div>
                    <label for="">Cover image</label>
                    <input type="file" class="form-control my-2"  placeholder="Password" />
                </div>
                <div>
                    <label for="">Music file</label>
                    <input type="file" class="form-control my-2"  placeholder="Password" />
               

                </div>
                <div class="form-floating">
                    <input type="text" class="form-control my-2" id="floatingPassword" placeholder="Password" />
                    <label for="floatingPassword">Music Name</label>

                </div>
                <div class="form-floating">
                    <textarea type="text" class="form-control my-2" id="floatingPassword" placeholder="Password" />
                    <label for="floatingPassword">Music Description</label>

                </div>
                <div class="">
                    <button class="w-100 btn btn-primary mt-2">Upload</button>
                    
                </div>
            </div>

        </div>

    </div>
</template>

<script>
</script>

<style></style>