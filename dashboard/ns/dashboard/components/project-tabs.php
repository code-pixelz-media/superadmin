<div class="tab-header d-flex justify-content-between align-items-center">
  <ul class="nav nav-tabs dzn-tabs" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Board</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">Files</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">Brief</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="simple-tab-3" data-bs-toggle="tab" href="#simple-tabpanel-3" role="tab" aria-controls="simple-tabpanel-3" aria-selected="false">Message <span class="dzn-capsule-small bg-red xxsmallfont color-white">12</span></a>
    </li>
  </ul>
  <ul class="d-flex justify-content-end dzn-header-right-buttons">
    <li><a href="#offcanvasNewTask" data-bs-toggle="offcanvas" role="button" aria-controls="offcanvasNewTask"><img src="assets/images/icon-plus-aqua.svg"> New Task </a></li>
    <li><a href=""><img src="assets/images/sort.svg"> </a></li>
  </ul>
</div>

<div class="tab-content dzn-tab-content" id="tab-content">
  <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
    <?php include('tab-accordion.php'); ?>
  </div>
  <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-1">
  <?php include('tab-files.php'); ?>
  </div>
  <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">
  <?php include('tab-brief.php'); ?>
  </div>
  <div class="tab-pane" id="simple-tabpanel-3" role="tabpanel" aria-labelledby="simple-tab-3">Messages selected</div>
</div>
<div class="offcanvas offcanvas-end dzn-offcanvas" tabindex="-1" id="offcanvasNewTask" aria labelledby="offcanvasNewtaskLabel">
    <?php include('components/offcanvas-newtask.php'); ?>
  </div>