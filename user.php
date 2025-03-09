<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>

    <main class="container">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand fw-bold" href="#">Admin panel</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">All Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">All User</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>

        <section class="mt-3">
            <div class="p-5 mb-4 bg-light rounded-3">
                <div class="container-fluid py-5">
                    <h1 class="display-5 fw-bold">All Users</h1>
                    <p class="col-md-8 fs-4">Using a series of utilities, you can create this jumbotron.</p>
                    <a class="btn btn-primary btn-lg" href="#">See website</a>
                </div>
            </div>
        </section>

        <section class="mt-3">
            <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">username</td>
                    <td scope="col">email</td>
                    <td scope="col">Status</td>
                    <td scope="col">date</td>
                </tr>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">username</td>
                    <td scope="col">email</td>
                    <td scope="col">Status</td>
                    <td scope="col">date</td>
                </tr>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">username</td>
                    <td scope="col">email</td>
                    <td scope="col">Status</td>
                    <td scope="col">date</td>
                </tr>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">username</td>
                    <td scope="col">email</td>
                    <td scope="col">Status</td>
                    <td scope="col">date</td>
                </tr>
                <tr>
                    <td scope="col">ID</td>
                    <td scope="col">username</td>
                    <td scope="col">email</td>
                    <td scope="col">Status</td>
                    <td scope="col">date</td>
                </tr>
            </tbody>
            </table>
        </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>