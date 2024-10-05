<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case CityView = 'city.view';
    case CityStore = 'city.store';
    case CityUpdate = 'city.update';
    case CityDelete = 'city.delete';

    case CinemaView = 'cinema.view';
    case CinemaStore = 'cinema.store';
    case CinemaUpdate = 'cinema.update';
    case CinemaDelete = 'cinema.delete';

    case DailyScreeningView = 'daily.screening.view';
    case DailyScreeningStore = 'daily.screening.store';
    case DailyScreeningUpdate = 'daily.screening.update';
    case DailyScreeningDelete = 'daily.screening.delete';

    case PerformanceView = 'performance.view';
    case PerformanceStore = 'performance.store';
    case PerformanceUpdate = 'performance.update';
    case PerformanceDelete = 'performance.delete';

    case AgentView = 'agent.view';
    case AgentStore = 'agent.store';
    case AgentUpdate = 'agent.update';
    case AgentDelete = 'agent.delete';

    case CommentView = 'comment.view';
    case CommentStore = 'comment.store';
    case CommentUpdate = 'comment.update';
    case CommentDelete = 'comment.delete';

    case ScoreView = 'score.view';
    case ScoreStore = 'score.store';
    case ScoreUpdate = 'score.update';
    case ScoreDelete = 'score.delete';

    case UserView = 'user.view';
    case UserStore = 'user.store';
    case UserUpdate = 'user.update';
    case UserDelete = 'user.delete';

    case UserTicketView = 'user.ticket.view';
    case UserTicketStore = 'user.ticket.store';
    case UserTicketUpdate = 'user.ticket.update';
    case UserTicketDelete = 'user.ticket.delete';

    case CategoryView = 'category.view';
    case CategoryStore = 'category.store';
    case CategoryUpdate = 'category.update';
    case CategoryDelete = 'category.delete';

}
