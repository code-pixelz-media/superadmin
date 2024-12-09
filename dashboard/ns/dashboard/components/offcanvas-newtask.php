<div class="offcanvas-header flex-column align-items-start">
  <h5 class="offcanvas-title lgfont fw-600" id="offcanvasNewTaskLabel">New Task </h5>
  <p class="smallfont mb-0">Create a new Task</p>
</div>
<div class="offcanvas-body">
  <div class="dzn-offcanvas-wrapper">
  <div class="dzn-form-container mt-0">
          <div class="dzn-form-content">

            <form class="d-flex" action="dashboard">
              <!-- Error and success message display -->
              <fieldset class="scheduler-border">
                <?php include_once('components/msg-error.php'); ?>
              </fieldset>
              <!-- Error and success message display end -->
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <label for="project-category">Priority</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>High</option>
                    <option value="1">Medium</option>
                    <option value="2">Moderate</option>
                    <option value="3">Low</option>
                  </select>
                </div>
                <div class="form-group date-field">
                  <label for="project-date">Date</label>
                  <input type="text" class="form-control" id="dzn_datepicker" name="dzn_datepicker" placeholder="01.10.2024">
                </div>
              </fieldset>
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <label for="project-title">Give your task a title</label>
                  <input type="text" class="form-control" id="dzn_project_title" name="dzn_project_title" placeholder="Create new logo">
                </div>
                <div class="form-group">
                  <label for="project-description">Description</label>
                  <textarea class="form-control" id="dzn_project_description" name="dzn_project_description" placeholder="Description"></textarea>
                  
                </div>
                
              </fieldset>
                
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <h4 class="mb-0">Attachments</h4>
                </div>
                <div class="form-group">
                  <label for="project-attachments">Files, examples and assets</label>
                  <div id="dzn-cp-fileUpload" class="file-container">
                    <label for="fileUpload-1" class="file-upload">
                      <div>
                        <i class="material-icons-outlined">cloud_upload</i>
                        <p>Drag &amp; Drop Files Here</p>
                        <span>OR</span>
                        <div>Browse Files</div>
                      </div>
                      <input type="file" id="fileUpload-1" name="[]" multiple="" hidden="">
                    </label>
                  </div>
                </div>
              </fieldset>
              <div class="button-wrapper text-center">
                <button type="submit" class="btn btn-primary btn-xlg" control-id="ControlID-6">Create Task</button>
              </div>

            </form>
          </div>

        </div>
  </div>
  
</div>