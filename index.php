<!DOCTYPE html>
<html>
<head>
    <title>全球搜索引擎</title>
</head>
<body>
    <h1>欢迎来到eamgjt搜索引擎</h1>
    <?php
    $query = isset($_GET['query']) ? $_GET['query'] : '';
    $searchResults = [];

    // 定义一个函数用于进行网页爬取和搜索
    function crawlAndSearch($query, $url) {
        $searchResults = [];

        // 在这里执行网页爬取
        $pageContent = file_get_contents($url);

        // 在页面内容中搜索查询词
        if (mb_stripos($pageContent, $query) !== false) {
            $searchResults[] = [
                'title' => '示例结果',
                'url' => $url,
                'snippet' => '包含查询词的内容摘要...'
            ];
        }

        return $searchResults;
    }

    if (!empty($query)) {
        // 为每个要爬取的网站调用crawlAndSearch函数
        $urls = [
            'https://www.baidu.com',
            'https://www.bing.com',
            'https://www.360.cn'
        ];

        foreach ($urls as $url) {
            $searchResults = array_merge($searchResults, crawlAndSearch($query, $url));
        }
    }
    ?>

    <form action="" method="get">
        <input type="text" name="query" value="<?php echo $query; ?>" placeholder="输入搜索词">
        <button type="submit">搜索</button>
    </form>

    <?php if (!empty($searchResults)): ?>
        <h2>搜索结果：</h2>
        <ul>
            <?php foreach ($searchResults as $result): ?>
                <li>
                    <a href="<?php echo $result['url']; ?>"><?php echo $result['title']; ?></a>
                    <p><?php echo $result['snippet']; ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>
