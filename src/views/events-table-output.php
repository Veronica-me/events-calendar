<div class="container mt-5">
  <div class="row">
    <!-- Previous Week Button -->
    <div class="col-1">
      <button class="btn btn-secondary" id="prevWeek">&lt;</button>
    </div>

    <!-- Days of the Week -->
    <div class="col-10">
      <div class="row">
        <div class="col day">Sunday</div>
        <div class="col day">Monday</div>
        <div class="col day">Tuesday</div>
        <div class="col day">Wednesday</div>
        <div class="col day">Thursday</div>
        <div class="col day">Friday</div>
        <div class="col day">Saturday</div>
      </div>
    </div>

    <!-- Next Week Button -->
    <div class="col-1">
      <button class="btn btn-secondary" id="nextWeek">&gt;</button>
    </div>
  </div>

  <!-- Week Planner -->
  <div class="row" id="planner">
    <!-- Content planner where here -->
  </div>
</div>

<script>
  const prevWeekButton = document.getElementById('prevWeek');
  const nextWeekButton = document.getElementById('nextWeek');
  const plannerContainer = document.getElementById('planner');
  let currentWeek = 0;
  let currentDate;
  let eventsData = {};

  prevWeekButton.addEventListener('click', () => {
    currentWeek--;
    updatePlanner();
  });

  nextWeekButton.addEventListener('click', () => {
    currentWeek++;
    updatePlanner();
  });

  function updatePlanner() {
    plannerContainer.innerHTML = '';

    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    const startDate = new Date();

    startDate.setDate(startDate.getDate() + currentWeek * 7 - startDate.getDay());

    days.forEach((day, index) => {
      const currentDate = new Date(startDate);
      currentDate.setDate(startDate.getDate() + index);

      const dayCard = document.createElement('div');
      dayCard.classList.add('daycard', 'col', 'day', 'border');
      dayCard.innerHTML = `<div class="day border-bottom">${day} (${formatDate(currentDate)})</div><div class="events mt-3"></div>`;
      plannerContainer.appendChild(dayCard);

      populateEvents(currentDate, dayCard.querySelector('.events'));
    });
  }

  function formatDate(date) {
    const options = {
      year: 'numeric',
      month: 'short',
      day: 'numeric'
    };
    return date.toLocaleDateString('en-US', options);
  }

  function populateEvents(date, eventsContainer) {
    const eventsForDate = eventsData[date.toISOString().split('T')[0]] || [];

    eventsForDate.forEach(event => {
      const eventItem = document.createElement('div');

      eventItem.classList.add('event-item');
      var refreshForm = "";

      refreshForm = `<form form-id='${event.id}'></form>`

      eventItem.innerHTML = `<h4>${event.title}</h4><i>${event.place}</i><p>${event.description}</p>`;

      const editButton = document.createElement('button');
      editButton.classList.add('editEvt');
      editButton.id = event.id;
      editButton.innerHTML = '<i class="fa fa-edit"></i>';
      editButton.addEventListener('click', function() {
        const eventId = this.id;
        console.log('Clicked edit button with id:', eventId);
        openUpdateForm(event, eventItem);
      });


      eventItem.appendChild(editButton);
      eventsContainer.appendChild(eventItem);

    });
  }

  function openUpdateForm(event, eventsContainer) {
    const eventUpdItem = document.createElement('div');
    const eventUpdForm = document.createElement('form');
    const updButton = document.createElement('button');
    updButton.id = "upd-" + event.id;
    updButton.classList.add('mt-2', 'mb-2', 'btn', 'btn-secondary');
    updButton.innerHTML = "Update";
    var eventForm = "";

    eventForm += `<input type="text" class="form-control" id="eventTitle" value="${event.title}" required="">`;
    eventForm += `<input type="text" class="form-control" id="eventPlace" value="${event.place}" placeholder="Event location">`;
    eventForm += `<textarea class="form-control" id="eventDescription" style="height: 8em;">${event.description}</textarea>`;

    eventUpdItem.classList.add('update-form');
    eventUpdForm.setAttribute('form-id', event.id);

    eventUpdForm.innerHTML = eventForm;

    updButton.addEventListener('click', function(e) {
      e.preventDefault();

      const updatedEvent = {
        id: event.id,
        title: document.getElementById('eventTitle').value,
        place: document.getElementById('eventPlace').value,
        description: document.getElementById('eventDescription').value
      };

      submitUpdateForm(updatedEvent);
    });

    eventUpdForm.addEventListener('submit', function(e) {
      e.preventDefault();
      submitUpdateForm(event.id);
    });

    eventUpdForm.appendChild(updButton);
    eventUpdItem.appendChild(eventUpdForm);
    eventsContainer.appendChild(eventUpdItem);
  }


  function submitUpdateForm(updatedEvent) {
  $.ajax({
    type: 'POST',
    url: 'src/Controllers/EventsOutputController.php?action=updateEvent',
    data: JSON.stringify(updatedEvent),
    contentType: 'application/json',
    dataType: 'json',
    success: function(response) {
      console.log('Event updated successfully:', response);

      fetch(`src/Controllers/EventsOutputController.php?action=getAllEvents`)
        .then(response => response.json())
        .then(data => {
          eventsData = organizeEventsByDate(data.events || []);
          updatePlanner(); 
        })
        .catch(error => console.error('Error fetching events:', error));
    },
    error: function(error) {
      console.error('Error updating event:', error);
    }
  });
}



  // Fetch all events once and organize them by date
  fetch(`src/Controllers/EventsOutputController.php?action=getAllEvents`)
    .then(response => response.json())
    .then(data => {
      eventsData = organizeEventsByDate(data.events || []);
      updatePlanner();
    })
    .catch(error => console.error('Error fetching events:', error));

  function organizeEventsByDate(events) {
    const organizedEvents = {};
    events.forEach(event => {
      const date = event.date.split(' ')[0];
      if (!organizedEvents[date]) {
        organizedEvents[date] = [];
      }
      organizedEvents[date].push(event);
    });
    return organizedEvents;
  }


  //edit
  document.querySelectorAll('.editEvt').forEach(button => {
    button.addEventListener('click', function() {
      const eventId = this.id;
      console.log('Clicked id:', eventId);
    });
  });
</script>