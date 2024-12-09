<?php include_once('templates/header.php'); ?>
<section class="dzn-main-container">
  <div class="container">
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 dzn-left-sidebar d-none d-md-block">
        <div class="logo pt-3 pb-3 dzn-main-sidebar">
          <?php include('templates/sidebar.php'); ?>
        </div>
      </div>
      <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 no-padding offset-lg-2 dzn-main-rght-wrapper">

        <div class="dzn-form-container">
          <div class="dzn-form-header">
            <h3 class="mb-0">Create Project</h3>
            <p>Scale up or down as needed, and pause or cancel at anytime.</p>

          </div>
          <div class="dzn-form-content">

            <form class="d-flex" action="dashboard">
              <!-- Error and success message display -->
              <fieldset class="scheduler-border">
                <?php include_once('components/msg-error.php'); ?>
              </fieldset>
              <!-- Error and success message display end -->
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <label for="project-category">Category</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Logo Design</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="form-group date-field">
                  <label for="project-date">Date</label>
                  <input type="text" class="form-control" id="dzn_datepicker" name="dzn_datepicker" placeholder="01.10.2024">
                </div>
              </fieldset>
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <label for="project-title">Give your project a title</label>
                  <input type="text" class="form-control" id="dzn_project_title" name="dzn_project_title" placeholder="Logo Design">
                </div>
                <div class="form-group">
                  <label for="project-description">Description of the organization and its target audience</label>
                  <div class="editor-container editor-container_classic-editor" id="editor-container">
					<div class="editor-container__editor"><div id="editor"></div></div>
				</div>
                  <textarea class="form-control" id="dzn_project_description" name="dzn_project_description" placeholder="Description"></textarea>
                  
                </div>
                <div class="form-group">
                  <label for="project-industry">Industry</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Corporate</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
              </fieldset>
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <h4 class="mb-0">Visual style</h4>
                </div>
                <div class="form-group">
                  <label for="project-style">Style/theme ideas</label>
                  <select class="form-select" aria-label="Default select example">
                    <option selected>Modern</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="project-inpirational">Inspirational</label>
                  <input type="text" class="form-control" id="dzn_project_inspirational" name="dzn_project_inspirational" placeholder="Links" />
                </div>
              </fieldset>
              <fieldset class="scheduler-border">
                <div class="form-group">
                  <h4 class="mb-0">Content details</h4>
                </div>
                <div class="form-group">
                  <label for="project-content-description">Descriptions</label>
                  <textarea class="form-control" id="dzn_contentdeailst_description" name="dzn_contentdeailst_description" placeholder="Description"></textarea>
                </div>
                <div class="form-group">
                  <label for="project-content-notes">Other notes</label>
                  <textarea class="form-control" id="dzn_other_notes" name="dzn_other_notes" placeholder="Description"></textarea>
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
                <button type="submit" class="btn btn-primary btn-xlg" control-id="ControlID-6">Create Project</button>
              </div>

            </form>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<?php include_once('templates/footer.php'); ?>