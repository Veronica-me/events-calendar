<!-- src/views/form-events.php -->
<div class="form-wrapper mt-5">
  <form id="eventForm">
    <div class="row form-group mb-3">
      <label for="eventDate" class="col-md-2 col-form-label">Date</label>
      <div class="col-sm-4">
        <div class="input-group date" id="datepicker">
          <input type="text" class="form-control" id="eventDate" required>
          <span class="input-group-append">
            <span class="input-group-text bg-white" style="height: 100%;">
              <i class="fa fa-calendar"></i>
            </span>
          </span>
        </div>
      </div>
      <div class="col-md-6" style="display:flex;">
        <label for="eventTime" class="col-form-label me-5">Select time:</label>
        <div class="col-sm-5">
          <input type="time" id="eventTime" name="eventTime" class="form-control">
          </div>  
      </div>

    </div>

    <div class="mb-3 form-floating">
      <input type="text" class="form-control" id="eventTitle" placeholder="Event title" required>
      
        <label for="eventTitle" class="form-label">Event title</label>
      
    </div>
    <div class="mb-3 form-floating">
      <input type="text" class="form-control" id="eventPlace" placeholder="Event location">
      <label for="eventPlace" class="form-label">Event location</label>
    </div>
    <div class="form-floating mb-3">
      <textarea class="form-control" placeholder="Leave a comment here" id="eventDescription" style="height: 10em;"></textarea>
      <label for="eventDescription">Event details</label>
    </div>

    <button type="submit" class="btn btn-primary">Create event</button>
  </form>
</div>
