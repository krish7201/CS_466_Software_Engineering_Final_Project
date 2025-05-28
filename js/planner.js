<script>
        document.addEventListener('DOMContentLoaded', function() {
            const monthYearElement = document.getElementById('month-year');
            const calendarDatesElement = document.getElementById('calendar-dates');
            const agendaListElement = document.getElementById('agenda-list');
            const upcomingEventsElement = document.getElementById('upcoming-events');
            const events = <?php echo $eventsJSON; ?>; // Parse JSON string into JavaScript object
            const datesDB = <?php echo $datesJSON; ?>;  //TO-DO: remove
            const titleDB = <?php echo $titleJSON; ?>;  //TO-DO: remove


            // Sample event data (replace this with your actual event data)
            
            // Depending on course input course name into front ... (CS-101) "Example"
            
            //test
            // Function to add a new event to the events object
            addEvent(datesDB, titleDB);


            let currentMonth; // Track current displayed month
            let currentYear; // Track current displayed year
            


            // Function to render calendar based on month and year
            function renderCalendar(month, year) {
                currentMonth = month;
                currentYear = year;

                // Clear existing calendar dates
                calendarDatesElement.innerHTML = '';

                // Set the month and year in the title
                monthYearElement.textContent = `${getMonthName(month)} ${year}`;

                // Get the first day of the month
                const firstDay = new Date(year, month - 1, 1);
                const startingDayOfWeek = firstDay.getDay();

                // Get the number of days in the month
                const daysInMonth = new Date(year, month, 0).getDate();

                // Create calendar rows and cells
                let date = 1;
                for (let i = 0; i < 6; i++) { // 6 weeks maximum to cover all possibilities
                    const row = document.createElement('tr');

                    // Create cells for each day of the week
                    for (let j = 0; j < 7; j++) {
                        const cell = document.createElement('td');
                        if (i === 0 && j < startingDayOfWeek) {
                            // Empty cells before the start of the month
                            cell.textContent = '';
                        } else if (date > daysInMonth) {
                            // Stop creating cells once all days of the month are added
                            break;
                        } else {
                            // Display the date
                            cell.textContent = date;
                            cell.classList.add('calendar-day'); // Add a class for styling and event handling
                            const currentDate = `${year}-${padZero(month)}-${padZero(date)}`;
                            cell.dataset.date = currentDate; // Store the date in dataset
                            date++;

                            // Check if the current date has events
                            if (events[currentDate]) {
                                // Add a dot or marker to indicate events
                                const dot = document.createElement('span');
                                dot.classList.add('event-dot');
                                cell.appendChild(dot);
                            }

                            // Add click event listener to each calendar day
                            cell.addEventListener('click', handleDayClick);
                        }
                        row.appendChild(cell);
                    }

                    calendarDatesElement.appendChild(row);

                    // Stop creating rows if we've added all days of the month
                    if (date > daysInMonth) {
                        break;
                    }
                }

                // Display upcoming events after rendering calendar
                displayUpcomingEvents();
            }

            // Helper function to get month name from month number (1-based index)
            function getMonthName(month) {
                const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
                return months[month - 1];
            }

            // Helper function to pad single digit number with leading zero (e.g., 1 => '01')
            function padZero(num) {
                return num.toString().padStart(2, '0');
            }

            // Event handler for day click
            function handleDayClick(event) {
                const selectedDate = event.target.dataset.date;
                if (selectedDate) {
                    displayAgenda(selectedDate);
                }
            }

            // Function to display agenda for the selected date
            function displayAgenda(selectedDate) {
            // Clear existing agenda items
                agendaListElement.innerHTML = '';

            // Display selected date above agenda items
                const selectedDateElement = document.createElement('p');
                selectedDateElement.textContent = `${formatDate(selectedDate)}`;
                agendaListElement.appendChild(selectedDateElement);

            // Check if there are events for the selected date
                if (events[selectedDate] && events[selectedDate].length > 0) {
                    events[selectedDate].forEach(event => {
                    // Create list item for the event
                        const listItem = document.createElement('li');

                    // Create span for the event text
                        const eventText = document.createElement('span');
                        eventText.textContent = event;
                        listItem.appendChild(eventText);

                    // Create delete button for the event
                        const deleteButton = document.createElement('button');
                        deleteButton.textContent = 'Delete';
                    deleteButton.classList.add('delete-button'); // Add class for styling
                    deleteButton.addEventListener('click', () => {
                        deleteEvent(selectedDate, event); // Call deleteEvent function on button click
                        updateCalendarEventIndicator(selectedDate); // Update calendar date indicator after deletion
                        displayAgenda(selectedDate); // Refresh agenda display after deletion
                    });
                    listItem.appendChild(deleteButton);

                    // Append list item to agenda list
                    agendaListElement.appendChild(listItem);
                });
                } else {
                    const listItem = document.createElement('li');
                    listItem.textContent = 'No events for this date';
                    agendaListElement.appendChild(listItem);

                // If no events, remove event indicator from calendar date
                    updateCalendarEventIndicator(selectedDate);
                }

            // Show or hide the "Add Event" button based on whether a date is selected
                const addEventButton = document.getElementById('add-event-button');
                if (selectedDate) {
                addEventButton.style.display = 'inline-block'; // Show "Add Event" button
                addEventButton.onclick = () => {
                    const newEvent = prompt('Enter new event:');
                    if (newEvent) {
                        addEvent(selectedDate, newEvent); // Add new event to events data structure
                        displayAgenda(selectedDate); // Refresh agenda display after adding event
                    }
                };
            } else {
                addEventButton.style.display = 'none'; // Hide "Add Event" button if no date is selected
            }
        }

            // Function to add a new event to the events object
        function addEvent(selectedDate, newEvent) {
            if (!events[selectedDate]) {
                events[selectedDate] = []; // Initialize array if events don't exist for the date
            }
            events[selectedDate].push(newEvent); // Add new event to the events array for the date

            // Save events to localStorage or backend (optional)
            saveEventsToStorage(); // Custom function to save events to localStorage or backend
        }

            // Function to save events to localStorage (example)
        function saveEventsToStorage() {
            localStorage.setItem('events', JSON.stringify(events));
        }

            // Function to load events from localStorage (example)
        function loadEventsFromStorage() {
            const storedEvents = localStorage.getItem('events');
            if (storedEvents) {
                events = JSON.parse(storedEvents);
            } else {
                events = {}; // Initialize events as empty object if no events are stored
            }
        }

            // Function to delete an event from the events object

        function deleteEvent(selectedDate, eventToDelete) {

            if (events[selectedDate]) {
                // Filter out the event to delete
                events[selectedDate] = events[selectedDate].filter(event => event !== eventToDelete);

                // If no more events for the date, remove the date from events object
                if (events[selectedDate].length === 0) {
                    delete events[selectedDate];
                    
                }

                // Immediately update calendar date indicator after deletion
                updateCalendarEventIndicator(selectedDate);

                // Refresh agenda display after deletion (if needed)
                displayAgenda(selectedDate);
            }
        }


            // Function to update calendar date indicator based on events presence
        function updateCalendarEventIndicator(selectedDate) {
            const calendarDateCell = document.getElementById(`calendar-date-${selectedDate}`);
            const eventDot = document.getElementById(`event-dot-${selectedDate}`);

            if (calendarDateCell && eventDot) {
                if (events[selectedDate] && events[selectedDate].length > 0) {
                    calendarDateCell.classList.add('has-events');
                    eventDot.style.display = 'inline-block'; // Show event dot
                } else {
                    calendarDateCell.classList.remove('has-events');
                    eventDot.style.display = 'none'; // Hide event dot
                }
            }
        }



            // Function to format date in a readable format (e.g., April 15, 2024)
        function formatDate(dateString) {
            const [year, month, day] = dateString.split('-');
            const monthName = getMonthName(parseInt(month));
            return `${monthName} ${parseInt(day)}, ${year}`;
        }

            // Function to display upcoming events for the next two weeks
        function displayUpcomingEvents() {
                upcomingEventsElement.innerHTML = ''; // Clear existing content

                const today = new Date();
                const endDate = new Date(today.getTime() + (14 * 24 * 60 * 60 * 1000)); // 14 days (2 weeks) from today

                let hasEvents = false;

                // Loop through each day within the next two weeks
                for (let date = new Date(today); date <= endDate; date.setDate(date.getDate() + 1)) {
                    const currentDate = `${date.getFullYear()}-${padZero(date.getMonth() + 1)}-${padZero(date.getDate())}`;
                    
                    if (events[currentDate]) {
                        events[currentDate].forEach(event => {
                            const eventDateString = formatDate(currentDate); // Format event date using formatDate function
                            const listItem = document.createElement('li');
                            listItem.textContent = `${eventDateString}: ${event}`;
                            upcomingEventsElement.appendChild(listItem);
                        });
                        hasEvents = true;
                    }
                }

                // Display message if no events within the next two weeks
                if (!hasEvents) {
                    upcomingEventsElement.textContent = 'Agenda clear for the next two weeks!';
                }
            }

            // Function to handle navigation to previous month
            function showPreviousMonth() {
                currentMonth--;
                if (currentMonth < 1) {
                    currentMonth = 12;
                    currentYear--;
                }
                renderCalendar(currentMonth, currentYear);
            }

            // Function to handle navigation to next month
            function showNextMonth() {
                currentMonth++;
                if (currentMonth > 12) {
                    currentMonth = 1;
                    currentYear++;
                }
                renderCalendar(currentMonth, currentYear);
            }

            // Initial render for current month and year
            const today = new Date();
            renderCalendar(today.getMonth() + 1, today.getFullYear());

            // Add event listeners to navigation buttons
            const prevMonthButton = document.getElementById('prev-month-button');
            const nextMonthButton = document.getElementById('next-month-button');

            prevMonthButton.addEventListener('click', showPreviousMonth);
            nextMonthButton.addEventListener('click', showNextMonth);
        });
    </script>