<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Products - SantriKoding.com</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container my-5">
    <div class="row">
      <div class="col-md-12">
        <div class="card border-0 shadow-sm rounded">
          <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <div class="mb-3">
                <label for="image" class="form-label fw-bold">IMAGE</label>
                <input type="file" id="image" name="image" accept="image/*" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="title" class="form-label fw-bold">TITLE</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $product->title) }}" placeholder="Masukkan Judul Product">
                @error('title')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>

              <div class="mb-3">
                <label for="description" class="form-label fw-bold">DESCRIPTION</label>
                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" placeholder="Masukkan Description Product">{{ old('description', $product->description) }}</textarea>
                @error('description')
                  <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="price" class="form-label fw-bold">PRICE</label>
                    <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" placeholder="Masukkan Harga Product">
                    @error('price')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="mb-3">
                    <label for="stock" class="form-label fw-bold">STOCK</label>
                    <input type="number" id="stock" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" placeholder="Masukkan Stock Product">
                    @error('stock')
                      <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                </div>
              </div>

              <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">UPDATE</button>
                <button type="reset" class="btn btn-warning">RESET</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('description');
  </script>
</body>
</html>
