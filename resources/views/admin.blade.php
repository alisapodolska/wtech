<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Aroma UA - Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Imperial+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-styles.css') }}">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <header class="logo">
            <a class="navbar-brand" href="#">The Aroma UA</a>
        </header>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('catalog') }}">Shop</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about-us') }}">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile') }}">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('search') }}">Search</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('cart') }}">Bag</a></li>
            </ul>
        </div>
    </div>
</nav>


<section class="admin-header py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h2 class="admin-title">Admin</h2>
        <div class="admin-actions">
            <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#addProductModal">+ Add Product</button>
            <button class="btn btn-outline-danger">Log Out</button>
        </div>
    </div>
</section>

<div class="container mt-3">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>

<!-- Add Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('products.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Name *</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label">Price (€) *</label>
                        <input type="number" step="0.01" max="150" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                        @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description *</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Image 1 -->
                    <div class="mb-3">
                        <label for="image1" class="form-label">Image 1 URL *</label>
                        <input type="url" class="form-control @error('image1') is-invalid @enderror" id="image1" name="image1" value="{{ old('image1') }}" required>
                        @error('image1')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Image 2 -->
                    <div class="mb-3">
                        <label for="image2" class="form-label">Image 2 URL *</label>
                        <input type="url" class="form-control @error('image2') is-invalid @enderror" id="image2" name="image2" value="{{ old('image2') }}" required>
                        @error('image2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Volume -->
                    <div class="mb-3">
                        <label for="volume" class="form-label">Volume</label>
                        <input type="text" class="form-control @error('volume') is-invalid @enderror" id="volume" name="volume" value="{{ old('volume') }}">
                        @error('volume')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Ingredients -->
                    <div class="mb-3">
                        <label for="ingredients" class="form-label">Ingredients</label>
                        <textarea class="form-control @error('ingredients') is-invalid @enderror" id="ingredients" name="ingredients" rows="3">{{ old('ingredients') }}</textarea>
                        @error('ingredients')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Scent -->
                    <div class="mb-3">
                        <label for="scent" class="form-label">Scent</label>
                        <select class="form-control @error('scent') is-invalid @enderror" id="scent" name="scent">
                            <option value="">Select Scent</option>
                            <option value="Floral" {{ old('scent') == 'ATLANTIC COAST' ? 'selected' : '' }}>ATLANTIC COAST</option>
                            <option value="Citrus" {{ old('scent') == 'LOST GARDEN' ? 'selected' : '' }}>LOST GARDEN</option>
                            <option value="Woody" {{ old('scent') == 'GRASSLAND' ? 'selected' : '' }}>GRASSLAND</option>
                            <option value="Oriental" {{ old('scent') == 'WOODLAND' ? 'selected' : '' }}>WOODLAND</option>
                            <option value="Other" {{ old('scent') == 'HERB GARDEN' ? 'selected' : '' }}>HERB GARDEN</option>
                        </select>
                        @error('scent')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Stock -->
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock</label>
                        <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock', 100) }}">
                        @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Type -->
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control @error('type') is-invalid @enderror" id="type" name="type">
                            <option value="" {{ old('type') == '' ? 'selected' : '' }}>Select a type</option>
                            <option value="Eau de Parfum" {{ old('type') == 'Eau de Parfum' ? 'selected' : '' }}>Eau de Parfum</option>
                            <option value="Eau de Toilette" {{ old('type') == 'Eau de Toilette' ? 'selected' : '' }}>Eau de Toilette</option>
                            <option value="Body Lotion" {{ old('type') == 'Body Lotion' ? 'selected' : '' }}>Body Lotion</option>
                            <option value="Castile Soap" {{ old('type') == 'Castile Soap' ? 'selected' : '' }}>Castile Soap</option>
                        </select>
                        @error('type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>


<section class="product-list py-5">
    <div class="container">
        <div class="product-items">
            @forelse ($products as $product)
                <div class="product-item d-flex align-items-center justify-content-between border-bottom py-3">
                    <div class="d-flex align-items-center">
                        <img src="{{ $product->image1 }}" alt="{{ $product->name }}" class="item-image">
                        <div class="item-details ms-3">
                            <p class="mb-0">{{ $product->name }}: {{ $product->volume }}</p>
                            <p class="mb-0 text-muted">Stock: 100</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <p class="price mb-0">€{{ number_format($product->price, 2) }}</p>
                        <!-- Update Button: Triggers the modal -->
                        <button class="btn btn-sm btn-outline-warning ms-3" data-bs-toggle="modal" data-bs-target="#updateProductModal{{ $product->id }}">Update</button>
                        <button class="btn btn-sm btn-outline-danger ms-2" data-bs-toggle="modal" data-bs-target="#deleteProductModal{{ $product->id }}">Delete</button>
                    </div>
                </div>

                <!-- Update Modal for this Product -->
                <div class="modal fade" id="updateProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="updateProductModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="updateProductModalLabel{{ $product->id }}">Update Product: {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <!-- Update Form -->
                                <form action="{{ route('products.update', $product->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label for="name{{ $product->id }}" class="form-label">Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name{{ $product->id }}" name="name" value="{{ old('name', $product->name) }}" required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Price -->
                                    <div class="mb-3">
                                        <label for="price{{ $product->id }}" class="form-label">Price (€) *</label>
                                        <input type="number" step="0.01" max="150" class="form-control @error('price') is-invalid @enderror" id="price{{ $product->id }}" name="price" value="{{ old('price', $product->price) }}" required>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Description -->
                                    <div class="mb-3">
                                        <label for="description{{ $product->id }}" class="form-label">Description *</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description{{ $product->id }}" name="description" required>{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image 1 -->
                                    <div class="mb-3">
                                        <label for="image1{{ $product->id }}" class="form-label">Image 1 URL *</label>
                                        <input type="url" class="form-control @error('image1') is-invalid @enderror" id="image1{{ $product->id }}" name="image1" value="{{ old('image1', $product->image1) }}" required>
                                        @error('image1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Image 2 -->
                                    <div class="mb-3">
                                        <label for="image2{{ $product->id }}" class="form-label">Image 2 URL *</label>
                                        <input type="url" class="form-control @error('image2') is-invalid @enderror" id="image2{{ $product->id }}" name="image2" value="{{ old('image2', $product->image2) }}" required>
                                        @error('image2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Volume -->
                                    <div class="mb-3">
                                        <label for="volume{{ $product->id }}" class="form-label">Volume</label>
                                        <input type="text" class="form-control @error('volume') is-invalid @enderror" id="volume{{ $product->id }}" name="volume" value="{{ old('volume', $product->volume) }}">
                                        @error('volume')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Scent -->
                                    <div class="mb-3">
                                        <label for="scent{{ $product->id }}" class="form-label">Scent</label>
                                        <select class="form-control @error('scent') is-invalid @enderror" id="scent{{ $product->id }}" name="scent">
                                            <option value="" {{ old('scent', $product->scent) == '' ? 'selected' : '' }}>Select a scent</option>
                                            <option value="Floral" {{ old('scent', $product->scent) == 'Floral' ? 'selected' : '' }}>Floral</option>
                                            <option value="Citrus" {{ old('scent', $product->scent) == 'Citrus' ? 'selected' : '' }}>Citrus</option>
                                            <option value="Woody" {{ old('scent', $product->scent) == 'Woody' ? 'selected' : '' }}>Woody</option>
                                            <option value="Oriental" {{ old('scent', $product->scent) == 'Oriental' ? 'selected' : '' }}>Oriental</option>
                                            <option value="Other" {{ old('scent', $product->scent) == 'Other' ? 'selected' : '' }}>Other</option>
                                        </select>
                                        @error('scent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Type -->
                                    <div class="mb-3">
                                        <label for="type{{ $product->id }}" class="form-label">Type</label>
                                        <select class="form-control @error('type') is-invalid @enderror" id="type{{ $product->id }}" name="type">
                                            <option value="" {{ old('type', $product->type) == '' ? 'selected' : '' }}>Select a type</option>
                                            <option value="Eau de Parfum" {{ old('type', $product->type) == 'Eau de Parfum' ? 'selected' : '' }}>Eau de Parfum</option>
                                            <option value="Eau de Toilette" {{ old('type', $product->type) == 'Eau de Toilette' ? 'selected' : '' }}>Eau de Toilette</option>
                                            <option value="Body Lotion" {{ old('type', $product->type) == 'Body Lotion' ? 'selected' : '' }}>Body Lotion</option>
                                            <option value="Castile Soap" {{ old('type', $product->type) == 'Castile Soap' ? 'selected' : '' }}>Castile Soap</option>
                                        </select>
                                        @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Delete Modal for this Product -->
                <div class="modal fade" id="deleteProductModal{{ $product->id }}" tabindex="-1" aria-labelledby="deleteProductModalLabel{{ $product->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteProductModalLabel{{ $product->id }}">Delete Product: {{ $product->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>? This action cannot be undone.</p>
                            </div>
                            <div class="modal-footer">
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <p>No products available.</p>
            @endforelse
        </div>
    </div>
</section>


<footer>
    <div class="footer-container">
        <div class="footer-logo">
            <h2>The Aroma UA</h2>
        </div>
        <div class="footer-links">
            <div class="footer-column">
                <h3>The Aroma UA</h3>
                <ul>
                    <li><a href="{{ route('about-us') }}">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Our Philosophy</h3>
                <p>We make perfumes and cosmetics using natural and organic ingredients. We take our inspiration from the landscape around us. Everything is made by hand, on site, in the Burren.</p>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <p>© The Aroma UA 2025<br>All rights reserved.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>