<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case CityStore = 'city.store';
    case CityUpdate = 'city.update';
    case CityDelete = 'city.delete';

    case CinemaStore = 'cinema.store';
    case CinemaUpdate = 'cinema.update';
    case CinemaDelete = 'cinema.delete';

    case DailyScreeningStore = 'daily.screening.store';
    case DailyScreeningUpdate = 'daily.screening.update';
    case DailyScreeningDelete = 'daily.screening.delete';

    case PerformanceStore = 'performance.store';
    case PerformanceUpdate = 'performance.update';
    case PerformanceDelete = 'performance.delete';

    case AgentStore = 'agent.store';
    case AgentUpdate = 'agent.update';
    case AgentDelete = 'agent.delete';

    case CommentView = 'comment.view';
    case CommentDelete = 'comment.delete';

    case ScoreView = 'score.view';
    case ScoreDelete = 'score.delete';

    case UserView = 'user.view';
    case UserStore = 'user.store';
    case UserUpdate = 'user.update';
    case UserDelete = 'user.delete';

    case UserTicketView = 'user.ticket.view';
    case UserTicketStore = 'user.ticket.store';
    case UserTicketUpdate = 'user.ticket.update';
    case UserTicketDelete = 'user.ticket.delete';

    case CategoryStore = 'category.store';
    case CategoryUpdate = 'category.update';
    case CategoryDelete = 'category.delete';

}
