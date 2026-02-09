<?php
// Configuration de la page
$pageTitle = 'Modals - Bootstrap 5 Elements';
$pageDescription = 'Bootstrap 5 modal examples - dialogs with different sizes, animations, and forms';
$pageKeywords = 'bootstrap, modals, dialogs, popup, overlay, forms, lightbox';
$pageName = 'elements';
$currentPage = 'elements-modals';
$bodyClass = 'elements-page';
$additionalScripts = '<link href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.29.0/themes/prism-tomorrow.min.css" rel="stylesheet">';

// Inclure le header
include __DIR__ . '/../inc/header.php';

// Inclure le sidebar
include __DIR__ . '/../inc/sidebar.php';
?>

<div class="container-fluid p-4">
                    
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb" class="mb-4">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/metis/elements">Elements</a></li>
                            <li class="breadcrumb-item active">Modals</li>
                        </ol>
                    </nav>

                    <!-- Page Header -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div>
                            <h1 class="h3 mb-0">Modals</h1>
                            <p class="text-muted mb-0">Dialogs with different sizes, animations, and forms</p>
                        </div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-secondary" onclick="window.history.back()">
                                <i class="bi bi-arrow-left me-2"></i>Back
                            </button>
                            <button class="btn btn-primary" onclick="copyAllCode()">
                                <i class="bi bi-clipboard me-2"></i>Copy All
                            </button>
                        </div>
                    </div>

                    <!-- Modal Examples -->
                    <div class="row g-4">
                        
                        <!-- Basic Modal -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Basic Modal</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal">
                                            Launch demo modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Button trigger modal --&gt;
&lt;button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#basicModal"&gt;
  Launch demo modal
&lt;/button&gt;

&lt;!-- Modal --&gt;
&lt;div class="modal fade" id="basicModal" tabindex="-1" aria-labelledby="basicModalLabel" aria-hidden="true"&gt;
  &lt;div class="modal-dialog"&gt;
    &lt;div class="modal-content"&gt;
      &lt;div class="modal-header"&gt;
        &lt;h1 class="modal-title fs-5" id="basicModalLabel"&gt;Modal title&lt;/h1&gt;
        &lt;button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"&gt;&lt;/button&gt;
      &lt;/div&gt;
      &lt;div class="modal-body"&gt;
        Woo-hoo, you're reading this text in a modal!
      &lt;/div&gt;
      &lt;div class="modal-footer"&gt;
        &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
        &lt;button type="button" class="btn btn-primary"&gt;Save changes&lt;/button&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Sizes -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Modal Sizes</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#smallModal">
                                            Small modal
                                        </button>
                                        <button type="button" class="btn btn-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#largeModal">
                                            Large modal
                                        </button>
                                        <button type="button" class="btn btn-info me-2 mb-2" data-bs-toggle="modal" data-bs-target="#extraLargeModal">
                                            Extra large modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Small modal --&gt;
&lt;div class="modal-dialog modal-sm"&gt;
  ...
&lt;/div&gt;

&lt;!-- Large modal --&gt;
&lt;div class="modal-dialog modal-lg"&gt;
  ...
&lt;/div&gt;

&lt;!-- Extra large modal --&gt;
&lt;div class="modal-dialog modal-xl"&gt;
  ...
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Fullscreen Modal -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Fullscreen Modal</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#fullscreenModal">
                                            Full screen
                                        </button>
                                        <button type="button" class="btn btn-secondary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#fullscreenSmModal">
                                            Full screen below sm
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Full screen modal --&gt;
&lt;div class="modal-dialog modal-fullscreen"&gt;
  ...
&lt;/div&gt;

&lt;!-- Full screen below sm --&gt;
&lt;div class="modal-dialog modal-fullscreen-sm-down"&gt;
  ...
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Vertically Centered Modal -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Vertically Centered</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#centeredModal">
                                            Vertically centered modal
                                        </button>
                                        <button type="button" class="btn btn-secondary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#scrollableModal">
                                            Vertically centered scrollable modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Vertically centered modal --&gt;
&lt;div class="modal-dialog modal-dialog-centered"&gt;
  ...
&lt;/div&gt;

&lt;!-- Vertically centered scrollable modal --&gt;
&lt;div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"&gt;
  ...
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Modal with Form -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Modal with Form</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#formModal">
                                            Open form modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;div class="modal fade" id="formModal" tabindex="-1"&gt;
  &lt;div class="modal-dialog"&gt;
    &lt;div class="modal-content"&gt;
      &lt;div class="modal-header"&gt;
        &lt;h1 class="modal-title fs-5"&gt;New message&lt;/h1&gt;
        &lt;button type="button" class="btn-close" data-bs-dismiss="modal"&gt;&lt;/button&gt;
      &lt;/div&gt;
      &lt;div class="modal-body"&gt;
        &lt;form&gt;
          &lt;div class="mb-3"&gt;
            &lt;label for="recipient-name" class="col-form-label"&gt;Recipient:&lt;/label&gt;
            &lt;input type="text" class="form-control" id="recipient-name"&gt;
          &lt;/div&gt;
          &lt;div class="mb-3"&gt;
            &lt;label for="message-text" class="col-form-label"&gt;Message:&lt;/label&gt;
            &lt;textarea class="form-control" id="message-text"&gt;&lt;/textarea&gt;
          &lt;/div&gt;
        &lt;/form&gt;
      &lt;/div&gt;
      &lt;div class="modal-footer"&gt;
        &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
        &lt;button type="button" class="btn btn-primary"&gt;Send message&lt;/button&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Static Backdrop Modal -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Static Backdrop</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropModal">
                                            Launch static backdrop modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Button trigger modal --&gt;
&lt;button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdropModal"&gt;
  Launch static backdrop modal
&lt;/button&gt;

&lt;!-- Modal --&gt;
&lt;div class="modal fade" id="staticBackdropModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"&gt;
  &lt;div class="modal-dialog"&gt;
    &lt;div class="modal-content"&gt;
      &lt;div class="modal-header"&gt;
        &lt;h1 class="modal-title fs-5"&gt;Modal title&lt;/h1&gt;
        &lt;button type="button" class="btn-close" data-bs-dismiss="modal"&gt;&lt;/button&gt;
      &lt;/div&gt;
      &lt;div class="modal-body"&gt;
        I will not close if you click outside me. Don't even try to press escape key.
      &lt;/div&gt;
      &lt;div class="modal-footer"&gt;
        &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
        &lt;button type="button" class="btn btn-primary"&gt;Understood&lt;/button&gt;
      &lt;/div&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Scrolling Long Content Modal -->
                        <div class="col-lg-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Scrolling Long Content</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#longContentModal">
                                            Long content modal
                                        </button>
                                        <button type="button" class="btn btn-secondary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#scrollableBodyModal">
                                            Scrollable body modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Scrollable modal --&gt;
&lt;div class="modal-dialog modal-dialog-scrollable"&gt;
  &lt;div class="modal-content"&gt;
    &lt;div class="modal-header"&gt;
      &lt;h1 class="modal-title fs-5"&gt;Modal title&lt;/h1&gt;
      &lt;button type="button" class="btn-close" data-bs-dismiss="modal"&gt;&lt;/button&gt;
    &lt;/div&gt;
    &lt;div class="modal-body"&gt;
      &lt;p&gt;This is some placeholder content to show the scrolling behavior for modals...&lt;/p&gt;
    &lt;/div&gt;
    &lt;div class="modal-footer"&gt;
      &lt;button type="button" class="btn btn-secondary" data-bs-dismiss="modal"&gt;Close&lt;/button&gt;
      &lt;button type="button" class="btn btn-primary"&gt;Save changes&lt;/button&gt;
    &lt;/div&gt;
  &lt;/div&gt;
&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Optional Sizes Demo -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">All Modal Sizes Demo</h5>
                                </div>
                                <div class="card-body">
                                    <div class="element-preview-container">
                                        <button type="button" class="btn btn-outline-primary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#extraSmallModal">
                                            Extra small modal
                                        </button>
                                        <button type="button" class="btn btn-outline-secondary me-2 mb-2" data-bs-toggle="modal" data-bs-target="#defaultModal">
                                            Default modal
                                        </button>
                                        <button type="button" class="btn btn-outline-success me-2 mb-2" data-bs-toggle="modal" data-bs-target="#mediumModal">
                                            Medium modal
                                        </button>
                                        <button type="button" class="btn btn-outline-warning me-2 mb-2" data-bs-toggle="modal" data-bs-target="#largeModal2">
                                            Large modal
                                        </button>
                                        <button type="button" class="btn btn-outline-danger me-2 mb-2" data-bs-toggle="modal" data-bs-target="#extraLargeModal2">
                                            Extra large modal
                                        </button>
                                    </div>
                                    <div class="element-code-block">
                                        <pre><code class="language-html">&lt;!-- Extra small modal --&gt;
&lt;div class="modal-dialog modal-sm"&gt;&lt;/div&gt;

&lt;!-- Default modal --&gt;
&lt;div class="modal-dialog"&gt;&lt;/div&gt;

&lt;!-- Large modal --&gt;
&lt;div class="modal-dialog modal-lg"&gt;&lt;/div&gt;

&lt;!-- Extra large modal --&gt;
&lt;div class="modal-dialog modal-xl"&gt;&lt;/div&gt;</code></pre>
                                    </div>
                                    <button class="btn btn-sm btn-outline-secondary" onclick="copyCode(this)">
                                        <i class="bi bi-clipboard me-2"></i>Copy Code
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

<?php
// Inclure le footer
include __DIR__ . '/../inc/footer.php';
?>