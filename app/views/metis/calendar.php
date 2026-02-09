<?php
// Configuration de la page
$pageTitle = 'Calendar & Events - Modern Bootstrap Admin';
$pageDescription = 'Interactive calendar with event management and scheduling';
$pageKeywords = 'bootstrap, admin, dashboard, calendar, events, scheduling';
$pageName = 'calendar';
$currentPage = 'calendar';
$bodyClass = 'calendar-page';
$additionalScripts = '<script type="module" crossorigin src="/assets/assets-metis/calendar-BwMBVGZW.js"></script>';

// Inclure le header
include __DIR__ . '/../inc/header.php';

// Inclure le sidebar
include __DIR__ . '/../inc/sidebar.php';
?>

<div class="container-fluid p-4 p-lg-4">
                    
                    <!-- Calendar Container with Header -->
                    <div x-data="calendarComponent" x-init="init()">
                        <!-- Page Header -->
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h1 class="h3 mb-0">Calendar</h1>
                                <p class="text-muted mb-0">Schedule and manage your events</p>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-outline-secondary d-lg-none" @click="toggleSidebar()">
                                    <i class="bi bi-calendar3 me-2"></i>Mini Calendar
                                </button>
                                <button type="button" class="btn btn-outline-secondary" @click="exportCalendar()">
                                    <i class="bi bi-download me-2"></i>Export
                                </button>
                                <button type="button" class="btn btn-primary" @click="addEvent()">
                                    <i class="bi bi-plus-lg me-2"></i>Add Event
                                </button>
                            </div>
                        </div>

                        <!-- Calendar Container -->
                        <div class="calendar-container">
                        <div class="calendar-layout">
                            
                            <!-- Calendar Sidebar -->
                            <div class="calendar-sidebar" :class="{ 'mobile-show': sidebarVisible }">
                                <!-- Sidebar Header -->
                                <div class="calendar-sidebar-header">
                                    <h5 class="sidebar-title mb-0">Calendar</h5>
                                    <button class="btn btn-primary btn-sm" @click="addEvent()" title="Add Event">
                                        <i class="bi bi-plus-lg"></i>
                                    </button>
                                </div>
                                
                                <!-- Mini Calendar -->
                                <div class="mini-calendar">
                                    <div class="mini-calendar-header">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <button class="btn btn-sm btn-outline-secondary" @click="previousMonth()">
                                                <i class="bi bi-chevron-left"></i>
                                            </button>
                                            <h6 class="mb-0 fw-semibold" x-text="currentMonthYear"></h6>
                                            <button class="btn btn-sm btn-outline-secondary" @click="nextMonth()">
                                                <i class="bi bi-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Mini Calendar Days Header -->
                                    <div class="mini-calendar-weekdays">
                                        <div class="weekday">S</div>
                                        <div class="weekday">M</div>
                                        <div class="weekday">T</div>
                                        <div class="weekday">W</div>
                                        <div class="weekday">T</div>
                                        <div class="weekday">F</div>
                                        <div class="weekday">S</div>
                                    </div>
                                    
                                    <div class="mini-calendar-grid">
                                        <template x-for="day in miniCalendarDays" :key="day.date">
                                            <div class="mini-calendar-day" 
                                                 :class="{ 
                                                     'today': day.isToday, 
                                                     'other-month': day.isOtherMonth,
                                                     'selected': day.isSelected,
                                                     'has-events': day.hasEvents
                                                 }"
                                                 @click="selectDate(day.date)"
                                                 x-text="day.day"></div>
                                        </template>
                                    </div>
                                </div>

                                <!-- Event Categories -->
                                <div class="event-categories">
                                    <h6 class="category-title">Event Categories</h6>
                                    <div class="category-list">
                                        <label class="category-item">
                                            <input type="checkbox" x-model="visibleTypes" value="event" class="form-check-input">
                                            <span class="category-color" style="background: var(--bs-primary);"></span>
                                            <span class="category-name">Events</span>
                                            <span class="category-count" x-text="getCategoryCount('event')"></span>
                                        </label>
                                        <label class="category-item">
                                            <input type="checkbox" x-model="visibleTypes" value="meeting" class="form-check-input">
                                            <span class="category-color" style="background: var(--bs-success);"></span>
                                            <span class="category-name">Meetings</span>
                                            <span class="category-count" x-text="getCategoryCount('meeting')"></span>
                                        </label>
                                        <label class="category-item">
                                            <input type="checkbox" x-model="visibleTypes" value="task" class="form-check-input">
                                            <span class="category-color" style="background: var(--bs-warning);"></span>
                                            <span class="category-name">Tasks</span>
                                            <span class="category-count" x-text="getCategoryCount('task')"></span>
                                        </label>
                                        <label class="category-item">
                                            <input type="checkbox" x-model="visibleTypes" value="reminder" class="form-check-input">
                                            <span class="category-color" style="background: #8b5cf6;"></span>
                                            <span class="category-name">Reminders</span>
                                            <span class="category-count" x-text="getCategoryCount('reminder')"></span>
                                        </label>
                                        <label class="category-item">
                                            <input type="checkbox" x-model="visibleTypes" value="deadline" class="form-check-input">
                                            <span class="category-color" style="background: var(--bs-danger);"></span>
                                            <span class="category-name">Deadlines</span>
                                            <span class="category-count" x-text="getCategoryCount('deadline')"></span>
                                        </label>
                                    </div>
                                </div>

                                <!-- Upcoming Events -->
                                <div class="upcoming-events">
                                    <h6 class="upcoming-title">Upcoming Events</h6>
                                    <div class="upcoming-list">
                                        <template x-for="event in upcomingEvents.slice(0, 5)" :key="event.id">
                                            <div class="upcoming-item" @click="viewEvent(event)">
                                                <div class="upcoming-time">
                                                    <span class="time" x-text="event.timeStr"></span>
                                                    <span class="date" x-text="event.dateStr"></span>
                                                </div>
                                                <div class="upcoming-content">
                                                    <h6 class="upcoming-event-title" x-text="event.title"></h6>
                                                    <p class="upcoming-description" x-text="event.description"></p>
                                                </div>
                                                <div class="upcoming-indicator" :style="`background: ${getCategoryColor(event.type)}`"></div>
                                            </div>
                                        </template>
                                        
                                        <!-- Empty state -->
                                        <div x-show="upcomingEvents.length === 0" class="upcoming-empty">
                                            <i class="bi bi-calendar-check"></i>
                                            <p>No upcoming events</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Calendar Main Area -->
                            <div class="calendar-main">
                                
                                <!-- Calendar Header -->
                                <div class="calendar-header">
                                    <div class="calendar-nav-left">
                                        <button class="btn btn-link d-lg-none me-2 p-0" @click="sidebarVisible = !sidebarVisible">
                                            <i class="bi bi-list fs-5"></i>
                                        </button>
                                        <div class="calendar-nav-controls">
                                            <button class="btn btn-outline-secondary" @click="previousPeriod()">
                                                <i class="bi bi-chevron-left"></i>
                                            </button>
                                            <button class="btn btn-outline-primary" @click="goToToday()">Today</button>
                                            <button class="btn btn-outline-secondary" @click="nextPeriod()">
                                                <i class="bi bi-chevron-right"></i>
                                            </button>
                                        </div>
                                        <h3 class="calendar-title" x-text="currentPeriodTitle"></h3>
                                    </div>
                                    
                                    <div class="calendar-nav-right">
                                        <div class="view-switcher">
                                            <button class="view-btn" :class="{ 'active': currentView === 'month' }" @click="switchView('month')">
                                                <i class="bi bi-calendar3 me-1"></i>Month
                                            </button>
                                            <button class="view-btn" :class="{ 'active': currentView === 'week' }" @click="switchView('week')">
                                                <i class="bi bi-calendar2-week me-1"></i>Week
                                            </button>
                                            <button class="view-btn" :class="{ 'active': currentView === 'day' }" @click="switchView('day')">
                                                <i class="bi bi-calendar-day me-1"></i>Day
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Calendar Content -->
                                <div class="calendar-content">
                                    
                                    <!-- Month View -->
                                    <div x-show="currentView === 'month'" class="month-view">
                                        <!-- Month Grid Header -->
                                        <div class="month-header">
                                            <div class="month-header-day">Sunday</div>
                                            <div class="month-header-day">Monday</div>
                                            <div class="month-header-day">Tuesday</div>
                                            <div class="month-header-day">Wednesday</div>
                                            <div class="month-header-day">Thursday</div>
                                            <div class="month-header-day">Friday</div>
                                            <div class="month-header-day">Saturday</div>
                                        </div>
                                        
                                        <!-- Month Grid -->
                                        <div class="month-grid">
                                            <template x-for="day in calendarDays" :key="day.date">
                                                <div class="month-day" 
                                                     :class="{ 
                                                         'today': day.isToday, 
                                                         'other-month': day.isOtherMonth,
                                                         'selected': day.isSelected,
                                                         'has-events': day.events && day.events.length > 0
                                                     }"
                                                     @click="selectDay(day)"
                                                     @dblclick="addEventForDay(day)">
                                                    <div class="day-number" x-text="day.day"></div>
                                                    <div class="day-events">
                                                        <template x-for="(event, index) in day.events?.slice(0, 3)" :key="event.id">
                                                            <div class="day-event" 
                                                                 :class="`event-${event.type}`"
                                                                 @click.stop="viewEvent(event)"
                                                                 :title="event.title + ' - ' + event.time">
                                                                <span class="event-title" x-text="event.title"></span>
                                                            </div>
                                                        </template>
                                                        <div x-show="day.events && day.events.length > 3" 
                                                             class="more-events"
                                                             @click.stop="showMoreEvents(day)"
                                                             x-text="`+${day.events.length - 3} more`"></div>
                                                    </div>
                                                </div>
                                            </template>
                                        </div>
                                    </div>

                                    <!-- Week View -->
                                    <div x-show="currentView === 'week'" class="week-view">
                                        <!-- Week Header -->
                                        <div class="week-header">
                                            <div class="time-column">Time</div>
                                            <template x-for="day in weekDays" :key="day.date">
                                                <div class="week-day-header" :class="{ 'today': day.isToday }">
                                                    <div class="day-name" x-text="day.dayName"></div>
                                                    <div class="day-number" x-text="day.dayNumber"></div>
                                                </div>
                                            </template>
                                        </div>
                                        
                                        <!-- Week Grid -->
                                        <div class="week-grid">
                                            <div class="time-slots">
                                                <template x-for="hour in hours" :key="hour">
                                                    <div class="time-slot" x-text="hour"></div>
                                                </template>
                                            </div>
                                            <div class="week-days">
                                                <template x-for="day in weekDays" :key="day.date">
                                                    <div class="week-day-column" :class="{ 'today': day.isToday }">
                                                        <template x-for="hour in hours" :key="hour">
                                                            <div class="hour-slot" 
                                                                 @click="addEventAtTime(day.date, hour)"
                                                                 @dblclick="addEventAtTime(day.date, hour)">
                                                                <template x-for="event in getEventsForDateTime(day.date, hour)" :key="event.id">
                                                                    <div class="week-event" 
                                                                         :class="`event-${event.type}`"
                                                                         @click.stop="viewEvent(event)"
                                                                         :title="event.title + ' - ' + event.time">
                                                                        <div class="event-time" x-text="event.time"></div>
                                                                        <div class="event-title" x-text="event.title"></div>
                                                                    </div>
                                                                </template>
                                                            </div>
                                                        </template>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Day View -->
                                    <div x-show="currentView === 'day'" class="day-view">
                                        <div class="day-view-header">
                                            <div class="day-info">
                                                <h4 class="day-title" x-text="selectedDayTitle"></h4>
                                                <p class="day-date" x-text="selectedDayDate"></p>
                                            </div>
                                            <div class="day-stats">
                                                <div class="stat-item">
                                                    <span class="stat-value" x-text="getDayEventCount(selectedDay)"></span>
                                                    <span class="stat-label">Events</span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="day-schedule">
                                            <div class="schedule-times">
                                                <template x-for="hour in hours" :key="hour">
                                                    <div class="schedule-time" x-text="hour"></div>
                                                </template>
                                            </div>
                                            <div class="schedule-events">
                                                <template x-for="hour in hours" :key="hour">
                                                    <div class="schedule-hour" 
                                                         @click="addEventAtTime(selectedDay, hour)"
                                                         @dblclick="addEventAtTime(selectedDay, hour)">
                                                        <template x-for="event in getEventsForDateTime(selectedDay, hour)" :key="event.id">
                                                            <div class="schedule-event" 
                                                                 :class="`event-${event.type}`"
                                                                 @click.stop="viewEvent(event)">
                                                                <div class="event-time" x-text="event.time"></div>
                                                                <div class="event-title" x-text="event.title"></div>
                                                                <div class="event-description" x-text="event.description"></div>
                                                            </div>
                                                        </template>
                                                        
                                                        <!-- Current time indicator -->
                                                        <div x-show="isCurrentHour(hour) && isToday(selectedDay)" 
                                                             class="current-time-indicator"></div>
                                                    </div>
                                                </template>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>

<?php
// Inclure le footer
include __DIR__ . '/../inc/footer.php';
?>