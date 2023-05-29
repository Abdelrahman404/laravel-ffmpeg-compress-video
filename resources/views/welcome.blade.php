<!DOCTYPE html>
<html>
<head>
  <title>Video Upload</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="text-center">
      <h1>Upload Video</h1>
      <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="video">Select Video:</label>
          <input type="file" class="form-control-file" id="video" name="video" accept="video/*" required>
        </div>
        <button type="submit" class="btn btn-primary">Upload</button>
      </form>
    </div>
  </div>
</body>
</html>