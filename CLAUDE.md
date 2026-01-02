# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Package Overview

Laravel Shoppingcart is a shopping cart package for Laravel 10/11 applications. It provides cart management with session storage, database persistence, tax calculations, and event dispatching.

## Common Commands

```bash
# Run tests
composer test

# Run tests with coverage report
composer test-coverage

# Format code (PHP CS Fixer)
composer format

# Static analysis
composer psalm
```

## Architecture

### Core Components

**Cart** (`src/Cart.php`) - Main service class managing cart operations. Singleton registered in service container. Handles adding/updating/removing items, price calculations, and database persistence.

**CartItem** (`src/CartItem.php`) - Represents individual cart items. Uses magic `__get()` for calculated properties: `priceTax`, `subtotal`, `total`, `tax`, `taxTotal`, `model`.

**Buyable Interface** (`src/Contracts/Buyable.php`) - Models implement this to be directly added to cart. The `CanBeBought` trait provides default implementation.

### Data Flow

```
CartFacade → Cart (singleton) → Session (current state)
                             → Shoppingcart Model (persistence)
                             → Events (CartAdded, CartUpdated, CartRemoved, CartStored, CartRestored)
```

### Multiple Instances

Cart supports multiple instances (e.g., cart, wishlist) via `Cart::instance('name')`. Each stored separately in session with key pattern `shoppingcart.{instance}`.

### Database Persistence

- Table: `shoppingcarts` (configurable)
- Columns: `identifier` (primary key), `instance`, `content` (JSON)
- Use `Cart::store($identifier)` and `Cart::restore($identifier)`

## Configuration

Located in `config/config.php`:
- `tax` - Default tax rate percentage
- `database.table` - Table name for persistence
- `destroy_on_logout` - Clear cart on user logout
- `format` - Number formatting (decimals, separators)

## Code Style

- PSR-12 with PHP CS Fixer (see `.php-cs-fixer.dist.php`)
- Short array syntax `[]`
- Alphabetically sorted imports
- 4-space indentation
