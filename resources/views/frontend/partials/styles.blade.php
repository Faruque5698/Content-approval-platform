<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #f8f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
    }

    .navbar {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .navbar-brand {
        font-weight: 700;
        letter-spacing: 0.5px;
        color: #0d6efd !important;
    }

    .page-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    .page-title {
        position: relative;
        padding-bottom: 15px;
        margin-bottom: 2.5rem;
        text-align: center;
        color: #212529;
        font-weight: 700;
    }

    .page-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 4px;
        background: linear-gradient(to right, #0d6efd, #6f42c1);
        border-radius: 2px;
    }

    .search-container {
        max-width: 650px;
        margin: 0 auto 3rem;
    }

    .search-input {
        border-radius: 50px;
        padding: 0.8rem 1.5rem;
        border: 2px solid #e1e5eb;
        transition: all 0.3s;
    }

    .search-input:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }

    .search-btn {
        background: linear-gradient(to right, #0d6efd, #0b5ed7);
        border: none;
        border-radius: 50px;
        padding: 0.8rem 2rem;
        margin-left: -50px;
        transition: all 0.3s;
    }

    .search-btn:hover {
        background: linear-gradient(to right, #0b5ed7, #0a58ca);
        transform: translateY(-2px);
    }

    /* Fixed Card Layout Solution */

    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        justify-content: center;
    }

    .card-wrapper {
        width: 100%;
        max-width: 380px;
        flex: 0 0 31%;
        display: flex;
    }

    .equal-height-card {
        display: flex;
        flex-direction: column;
        width: 100%;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 12px;
        overflow: hidden;
        background: #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .equal-height-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .card-img-container {
        height: 220px;
        overflow: hidden;
        position: relative;
    }

    .fixed-size-img {
        width: 300px;
        height: 200px;
        object-fit: cover;
        object-position: center;
        display: block;
    }

    .equal-height-card:hover .img-fixed-size {
        transform: scale(1.05);
    }

    .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        padding: 1.75rem;
    }

    .card-title {
        font-weight: 700;
        margin-bottom: 0.8rem;
        color: #212529;
        font-size: 1.3rem;
        line-height: 1.3;
    }

    .card-text {
        flex-grow: 1;
        margin-bottom: 1.5rem;
        color: #495057;
        line-height: 1.6;
        font-size: 1rem;
    }

    .btn-read-more {
        align-self: flex-start;
        padding: 0.6rem 1.5rem;
        font-weight: 600;
        background: linear-gradient(to right, #0d6efd, #0b5ed7);
        border: none;
        border-radius: 50px;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-read-more:hover {
        background: linear-gradient(to right, #0b5ed7, #0a58ca);
        transform: translateX(10px);
        box-shadow: 0 5px 15px rgba(11, 94, 215, 0.4);
    }

    .no-posts {
        width: 100%;
        text-align: center;
        padding: 4rem;
        background-color: white;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
    }

    .no-posts h4 {
        color: #495057;
        margin-bottom: 1rem;
    }

    .no-posts p {
        color: #6c757d;
        font-size: 1.1rem;
    }

    .pagination-container {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }

    .footer {
        margin-top: 5rem;
        padding: 3rem 0;
        background: linear-gradient(to right, #1e3c72, #2a5298);
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
    }

    .footer p {
        margin-bottom: 0.5rem;
    }

    @media (max-width: 992px) {
        .card-wrapper {
            flex: 1 1 calc(50% - 1.5rem);
        }
    }

    @media (max-width: 576px) {
        .card-wrapper {
            flex: 1 1 100%;
        }

        .search-container {
            padding: 0 15px;
        }
    }
</style>
